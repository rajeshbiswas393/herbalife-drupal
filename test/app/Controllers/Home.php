<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Home extends BaseController
{
	public function index()
	{
	  	$userModel = new UserModel();
		$users = $userModel->getUsersList();
		$userCount = $userModel->getUserCount();
		$pageCount = $userModel->getPageCount();
		$data = array('users' => $users,'pageCount' => $pageCount);
		return view('welcome_message',$data);
	}
	public function saveUser()
	{
		$userModel = new UserModel();
		$currentUserId = $_POST['currentUserId'];
		$userFullName = $_POST['userFullName'];
		$userEmail = $_POST['userEmail'];
		$userPhone = $_POST['userPhone'];

		if(intval($currentUserId) ==0 )
		{
			if($img = $this->request->getFile('userProfilePicture'))
			{
				if ($img->isValid() && ! $img->hasMoved())
				{
					$newName = $img->getRandomName();
					$type = $img->getClientMimeType();
					$img->move('./uploads', $newName);
					$fileInsert = array(
						'name' => $newName,
						'type' => $type,
						'created_at' => date('Y-m-d G:i:s')
					);
					$uploadId = $userModel->createUpload($fileInsert);
	
					$userData = array(
						'full_name' => $userFullName,
						'email' => $userEmail,
						'phone_no' => $userPhone,
						'profile_picture_id' => $uploadId,
						'is_active' => true,
						'created_at' => date('Y-m-d G:i:s'),
						'updated_at' => date('Y-m-d G:i:s')
					);
					$userId = $userModel->createUser($userData);
					$response = array('status'=>1,'msg'=>'User Created successfully!');
	
				}
				else
				{
					$response = array('status'=>0,'msg'=>'Something went wrong!');
				}
			}
			echo json_encode($response);
		}
		else
		{
			$img = $this->request->getFile('userProfilePicture');
			if ($img->isValid() && ! $img->hasMoved())
			{
				$newName = $img->getRandomName();
				$type = $img->getClientMimeType();
				$img->move('./uploads', $newName);
				$fileInsert = array(
					'name' => $newName,
					'type' => $type,
					'created_at' => date('Y-m-d G:i:s')
				);
				$uploadId = $userModel->createUpload($fileInsert);
				$userData = array(
					'full_name' => $userFullName,
					'email' => $userEmail,
					'phone_no' => $userPhone,
					'profile_picture_id' => $uploadId,
					'updated_at' => date('Y-m-d G:i:s')
				);
			}
			else
			{
				$userData = array(
					'full_name' => $userFullName,
					'email' => $userEmail,
					'phone_no' => $userPhone,
					'updated_at' => date('Y-m-d G:i:s')
				);
			}
			$updateStatus = ($userModel->updateUser($currentUserId,$userData)?1:0);
			$response=array('status' => $updateStatus );
			echo json_encode($response);
		}
	
		
	}
	public function deleteUser()
	{
		$userModel = new UserModel();
		$userId = $_POST['id'];
		if($userModel->deleteUser($userId))
		{
			$response = array('status' =>1);
		}
		else
		{
			$response = array('status' =>1);
		}
		echo json_encode($response);
	}

	public function getUserDetails()
	{
		$userModel = new UserModel();
		$userId = $_POST['id'];
		$userDetail = $userModel->getUserDetails($userId);
		if($userDetail)
		{
			$response = array('status' =>1,'user'=> (array)$userDetail);
		}
		else
		{
			$response = array('status' =>0);
		}
		echo json_encode($response);
	}

	public function loadPageData()
	{
		$userModel = new UserModel();
		$page = $_POST['page'];
		$userList = $userModel->getUsersList($page);
		if($userList)
		{
			$response = array('status' =>1,'users'=> (array)$userList);
		}
		else
		{
			$response = array('status' =>0);
		}
		echo json_encode($response);
	}
}
