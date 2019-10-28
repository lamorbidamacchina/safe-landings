<?php

class DAO {

	protected $db;
  protected $private_key;
  protected $index_key;

	public function setDb($db)
	{
		$this->db = $db;
  }  
  
  public function setKey($private_key)
	{
		$this->key = $private_key;
  }  
  
  public function setIndexKey($index_key)
	{
		$this->index_key = $index_key;
  } 
  
  public function getBlindIndex($string)
	{
    $index_key = base64_decode($this->index_key);
    return bin2hex(
        sodium_crypto_pwhash(
            32,
            $string,
            $index_key,
            SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE,
            SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE
        )
    );
	}

  function insert($first_name,$last_name,$email,$phone,$privacy,$source,$ip) {
    if ($first_name.''=='' || $last_name.'' == '' || $email.'' == '' || $phone.'' == '' || $privacy.'' == '') {
      return false;
     } 
     else {
      // create blind index for encrypted searchable fields
      $email_hash = $this->getBlindIndex($email);
		  $phone_hash = $this->getBlindIndex($phone);
      // get key for encryption
      $key = $this->key;
      $key = base64_decode($key);
      // get nonce for encryption
      $nonce_email = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
      $nonce_phone = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
      // encrypt data
      $email = sodium_crypto_secretbox($email, $nonce_email, $key);
      $phone = sodium_crypto_secretbox($phone, $nonce_phone, $key);
      // encode data for saving into db
      $email = base64_encode($nonce_email . $email);
      $phone = base64_encode($nonce_phone . $phone);

      try {
        $query = $this->db->prepare('INSERT INTO subscribers (first_name, last_name, email, phone, privacy, email_hash, phone_hash, creation_date, source, ip) VALUES (:first_name,:last_name,:email,:phone,:privacy,:email_hash,:phone_hash,:creation_date,:source,:ip)');
        $query->bindParam(':first_name', $first_name);
        $query->bindParam(':last_name', $last_name);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':privacy', $privacy);
        $query->bindParam(':email_hash', $email_hash);
        $query->bindParam(':phone_hash', $phone_hash);
        $query->bindParam(':creation_date', date('Y-m-d H:i:s'));
        $query->bindParam(':source', $source);
        $query->bindParam(':ip', $ip);
        $query->execute();
        $id = $this->db->lastInsertId();
        return $id;
      }
      catch(PDOException $e) {
        //echo "Error: " . $e->getMessage();
        //exit();
        return false;
      }
     }
  }

  function exists_email($email) {
		if (!isset($email)) {
			return true;
		}
		try {
			$query = $this->db->prepare("SELECT id  FROM subscribers WHERE email_hash=?");
			$data = Array($email);
			$query->execute($data);
			$all_mails = $query->fetchAll();
			foreach($all_mails as $row) {
				return true;
			}
		} catch (PDOException $e) {
			$this->logger->writeDbError($e->getMessage(),$this);
		}
		return false;
  }
  
  function exists_phone($phone) {
		if (!isset($phone)) {
			return false;
			exit();
		}
		try {
			$query = $this->db->prepare("SELECT id FROM subscribers WHERE phone_hash=?");
			$data = Array($phone);
			$query->execute($data);
			$all_numbers = $query->fetchAll();
			foreach($all_numbers as $row) {
				return true;
			}
		} catch (PDOException $e) {
			$this->logger->writeDbError($e->getMessage(),$this);
		}
		return false;
	}

  function listEncrypted() {
		try {
			$query = $this->db->prepare('SELECT id, first_name, last_name, email, phone, privacy, creation_date from subscribers order by id desc');
			$query->execute();
			$rows = $query->fetchAll();
			return $rows;
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
  }

  public function dec($string) {
    $decoded = base64_decode($string);
    $key = base64_decode($this->key);
    $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
    $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');				
    try  {
      $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
      return $plaintext;
    } 
    catch (Error $ex) {
      return "Cannot decrypt data.";
    } 
    catch (Exception $ex) {
      return "Cannot decrypt data.";
    }
  }

  public function listItems($source,$id,$q,$start=0,$end=100,$email="",$phone="") {
		$where_clause = "";
    	if ($source != "") {
			$where_clause .= "(source = :source) and ";
		}
		if ($q != "") {
			$where_clause .= "(last_name LIKE :q ) and ";
		}
		if ($id != "") {
			$where_clause .= "(id = :id) and ";
		}
		if ($email != "") {
			$where_clause .= "(email_hash = :email_hash) and ";
		}
		if ($phone != "") {
			$where_clause .= "(phone_hash = :phone_hash) and ";
		}

		try {
			$sql = "SELECT id, first_name, last_name, email, phone, privacy, source, creation_date
			FROM  subscribers
			WHERE ".$where_clause." id <> ''
			ORDER BY id DESC
			LIMIT :start,:end";
			$query = $this->db->prepare($sql);
      if ($source != "") {
				$query->bindParam(':source', $source, PDO::PARAM_STR);
			}
			if ($q != "") {
				$query->bindParam(':q', $tempString = "%".$q."%", PDO::PARAM_STR);
			}
			if ($id != "") {
				$query->bindParam(':id', $id, PDO::PARAM_STR);
			}
			if ($email != "") {
				$query->bindParam(':email_hash', $email, PDO::PARAM_STR);
			}
			if ($phone != "") {
				$query->bindParam(':phone_hash', $phone, PDO::PARAM_STR);
			}
			$query->bindParam(':start', $start, PDO::PARAM_INT);
			$query->bindParam(':end', $end, PDO::PARAM_INT);
			$query->execute();
			$rows = $query->fetchAll();
			return $rows;
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
      return false;
		}
	}

  public function countItems($source,$id,$q="",$email="",$phone="") {
		$where_clause = "";
    if ($source != "") {
			$where_clause .= "(source = :source) and ";
		}
		if ($q != "") {
			$where_clause .= "(last_name LIKE :q ) and ";
		}
		if ($id != "") {
			$where_clause .= "(id = :id) and ";
    }
    if ($email != "") {
			$where_clause .= "(email_hash = :email_hash) and ";
		}
		if ($phone != "") {
			$where_clause .= "(phone_hash = :phone_hash) and ";
		}
		try {
			$sql = "SELECT count(id) as c FROM  subscribers
			WHERE ".$where_clause." id <> ''
			ORDER BY id DESC";
			$query = $this->db->prepare($sql);
      if ($source != "") {
				$query->bindParam(':source', $source, PDO::PARAM_STR);
			}
			if ($q != "") {
				$query->bindParam(':q', $tempString = "%".$q."%", PDO::PARAM_STR);
			}
			if ($id != "") {
				$query->bindParam(':id', $id, PDO::PARAM_STR);
      }
      if ($email != "") {
				$query->bindParam(':email_hash', $email, PDO::PARAM_STR);
			}
			if ($phone != "") {
				$query->bindParam(':phone_hash', $phone, PDO::PARAM_STR);
			}
			$query->execute();
			$rows = $query->fetchAll();
			return $rows;
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
      return false;
		}
	}



}
  


?>
