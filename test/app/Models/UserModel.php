<?php
namespace app\Models;
use CodeIgniter\Model;
use CodeIgniter\Database;
use CodeIgniter\Database\Config;
use CodeIgniter\Database\Database as DatabaseDatabase;
use CodeIgniter\Debug\Toolbar\Collectors\Database as CollectorsDatabase;
// This is the user model
class UserModel extends Model
{
	protected $table = 'user';
	protected $allowedFields = array('id','fullname','email','phone_no','profile_picture_id','is_active','created_at','updated_at');
	protected $db;

	public function __construct()
    {
        parent::__construct();
		$this->db = \Config\Database::connect();

    }

	public function getUsersList($pageNo = 1)
	{
		$pageEnd = ($pageNo*10);
		$pageStart = ($pageEnd-10);
		$sql = "SELECT * 
				FROM user
				ORDER BY id DESC 
				Limit $pageStart,$pageEnd";
		$query = $this->db->query($sql);
		$userList = $query->getResult();
		return $userList;
	}

	public function getUserCount()
	{
		$sql = "SELECT COUNT(*) as user_count FROM user";
		$query = $this->db->query($sql);
		$result = $query->getResult();
		return $result[0]->user_count;                     
	}

	public function getPageCount()
	{
		$sql = "SELECT COUNT(*) as user_count FROM user";
		$query = $this->db->query($sql);
		$result = $query->getResult();
		$userCount = $result[0]->user_count;
		$pageCount = intval($userCount/10);
		if(($pageCount%10) >0)
		{
			$pageCount++;
		}
		return $pageCount;                     
	}

	public function createUpload($FileUpload)
	{
		
		 $this->db->table('uploads')->insert($FileUpload);
		 return $this->db->insertID();
	}
	public function createUser($userData)
	{
		
		 $this->db->table('user')->insert($userData);
		 return $this->db->insertID();
	}
	public function deleteUser($userId)
	{
    	return $this->db->table('user')->delete(['id'=> $userId]);
	}
	public function getUserDetails($userId)
	{
		$sql = "SELECT user.*,uploads.name AS picture_path 
				FROM user 
					LEFT JOIN uploads  ON (user.profile_picture_id = uploads.upload_id)
				WHERE id = $userId";
		$query = $this->db->query($sql);
		$result = $query->getResult();
		if(count($result))
		{
			return (array)$result[0];
		}
		else
		{
			return false;
		}
		
	}

	public function updateUser($userId,$userData)
	{
		return $this->db->table('user')->update($userData,['id' => $userId]);
	}
}
?>