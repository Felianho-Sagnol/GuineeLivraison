<?php 
    require_once("db.php");
    require_once("functions.php");


    class User {
        protected $_db;

        public function __construct(){
            $this->_db = (new Db())->getDb();
        }

        public function deleteUser($id){
            $user = $this->existUser($id);
            if ($user){
                $this->deleteUserRestaurantByUserId($id);
                $_SESSION["user_suppression"] = "L'utilisateur de numéro --".$id."-- a été supprimé avec succès.";
                $req = $this->_db->prepare('DELETE FROM users WHERE id = ?');
                $req->execute(array($id));
            }else{
                $_SESSION["user_suppression"] = "L'utilisateur de numéro --".$id."-- n'existe pas";
            }
        }

        public function deleteUserRestaurantByUserId($id){
            $req = $this->_db->prepare('DELETE FROM restaurants WHERE ownerId = ?');
            $req->execute(array($id));
        }

        public function existUser($id){
            $req = $this->_db->prepare('SELECT id FROM users WHERE id = ?');
            $req->execute(array($id));
            if ($req->rowCount() == 0) return false;
            return true;
        }

        public function getUserById($id){
            $req = $this->_db->prepare('SELECT id,pseudo,phone,profile,password,ville,quartier,indication,isAdmin,onlineStatus,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM users WHERE id = ?');
            $req->execute(array($id));
            if ($req->rowCount() == 0) return null;
            return $req->fetch();
        }

        //verifie si un user existe avec son phone
        public function existUserWithPhone($phone){
            $req = $this->_db->prepare('SELECT phone FROM users WHERE phone = ?');
            $req->execute(array($phone));
            if ($req->rowCount() == 0) return false;
            return true;
        }

        public function existUserWithId($id){
            $req = $this->_db->prepare('SELECT phone FROM users WHERE id = ?');
            $req->execute(array($id));
            if ($req->rowCount() == 0) return false;
            return true;
        }

        /**
         * function pour prendre les information d'un user
         */
        public function getUser($phone){
            $req = $this->_db->prepare('SELECT id,pseudo,phone,profile,password,ville,quartier,indication,isAdmin,onlineStatus,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM users WHERE phone = ?');
            $req->execute(array($phone));
            if($req->rowCount() == 1){
                return $req->fetch();
                
            }
            return [];
        }

        /**
         * function pour prendre tous les user afin d'effectuer les operations sur eux
         *
         * @return void
         */
        public function getAllUsers(){
            $reponse = $this->_db->query('SELECT id,pseudo,phone,profile,password,ville,quartier,indication,isAdmin,onlineStatus,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM users');
            if($reponse->rowCount() == 0){
                return array();
            }else{
                $users = [];
                while ($donnees = $reponse->fetch()){
                    $users[] = $donnees;
                }
                return $users;
            }
            $reponse->closeCursor();
        }

        public function getAllAdmins(){
            $reponse = $this->_db->query('SELECT id,pseudo,phone,profile,password,ville,quartier,indication,isAdmin,onlineStatus,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM users WHERE isAdmin=1');
            if($reponse->rowCount() == 0){
                return array();
            }else{
                $users = [];
                while ($donnees = $reponse->fetch()){
                    $users[] = $donnees;
                }
                return $users;
            }
            $reponse->closeCursor();
        }


        //verifie si un user est administrateur
        public function isAdmin($phone){
            if ($this->existUserWithPhone($phone)){
                $req = $this->_db->prepare('SELECT isAdmin FROM users WHERE phone = ?');
                $req->execute(array($phone));
                $user = $req->fetch();
                if($user["isAdmin"] == 1) return true;
            }
            return false;
        }


        public function deleteAdminOption($id){
            if ($this->existUserWithId($id)){
                $req = $this->_db->prepare('UPDATE users SET isAdmin = 0 WHERE id = ?');
                $req->execute(array($id));
                $req->closeCursor();
            }
        }

        //function de connexion d'un user
        public function connecteUser(){
			$errors_number = 0;
			if(!empty($_POST['connexion'])){
				if(empty($_POST["phone"]) || !verif_phone($_POST["phone"])){
					$_SESSION["error_phone"] = "Donner le numéro de téléphone lors de la création de votre compte.";
					$errors_number += 1;
				}
				if(empty($_POST["password"]) || !verif_password($_POST["password"])){
					$_SESSION["error_password"] = "Votre mot de passe doit contenir des majuscules-chiffres-minuscules et au moins 6 caratères";
					$errors_number += 1;
				}
				if($errors_number == 0){
					$req = $this->_db->prepare('SELECT id,pseudo,phone,profile,password,ville,quartier,indication,isAdmin,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM users WHERE phone = ? AND password = ?');
					$req->execute(array($_POST["phone"],sha1($_POST["password"])));
					if($req->rowCount() == 1){
                        $reqUpdate = $this->_db->prepare('UPDATE users SET onlineStatus = 1 WHERE phone = ?');
			            $reqUpdate->execute(array($_POST["phone"]));
						$_SESSION['user'] = $req->fetch();
                    	$req->closeCursor();
                        if(isset($_GET['want_connect_has_admin'])){
                            header('location:../admin/index.php');
                        }
                        if(isset($_GET['want_see_my_acount'])){
                            header('location:../views/compte.php');
                        }
					}else{
						$_SESSION["error_compte_not_existe"] = "Aucun compte n'a été trouvé pour ces informations !";
					}
				}
			}
		}

        public function setOnlineStatusToZero(){
            $reqUpdate = $this->_db->prepare('UPDATE users SET onlineStatus = 0 WHERE id = ?');
			$reqUpdate->execute(array($_SESSION['user']['id']));
        }

        /**
         * Function de creation d'un user
         * @return void
         */
        public function createUser(){
			$errors_number = 0;
            $valide_password = 1;
			if(!empty($_POST['inscription'])){
				if(empty($_POST["pseudo"]) || !verif_name($_POST["pseudo"])){
					$_SESSION["error_pseudo"]="Donnez un nom qui commence par une lettre,au moins 2 caractères.";
					$errors_number += 1;
				}
				if(empty($_POST["phone"]) || !verif_phone($_POST["phone"])){
					$_SESSION["error_phone"]="Donnez un numéro de téléphone valide pour nous permettre de vous contacter .";
					$errors_number += 1;
				}
                if(empty($_POST["ville"])){
					$_SESSION["error_ville"]="Veuillez remplire ce champ.";
					$errors_number += 1;
				}
                if(empty($_POST["quartier"])){
					$_SESSION["error_quartier"]="Veuillez remplire ce champ.";
					$errors_number += 1;
				}
                if(empty($_POST["indication"])){
					$_SESSION["error_indication"]="Veuillez remplire ce champ.";
					$errors_number += 1;
				}
				if(empty($_POST["password"]) || !verif_password($_POST["password"])){
					$_SESSION["error_password"]="Un mot de passe doit contenir des majuscules,des chiffres,des minuscules et au moins 6 caractères!";
					$errors_number += 1;
                    $valide_password = 0;
				}
                if(empty($_POST["confirm_password"]) || !verif_password($_POST["confirm_password"])){
					$_SESSION["error_confirm_password"]="Un mot de passe doit contenir des majuscules,des chiffres,des minuscules et au moins 6 caractères!";
					$errors_number += 1;
				}else{
                    if($valide_password == 1 AND $_POST["password"] != $_POST["confirm_password"]){
                        $_SESSION["error_confirm_password"]="Le mot de passe de confirmation est différent du mot de passe initial.";
                        $errors_number += 1;
                    }
                }
				
				if($errors_number == 0){
                    $req = $this->_db->prepare('SELECT phone FROM users WHERE phone = ?');
                    $req->execute(array($_POST["phone"]));
                    $exist = $req->rowCount();//si cette variable est egale 0 on inscrit le visteur
                    if($exist == 0){
                    	$req = $this->_db->prepare(
                            'INSERT INTO users(pseudo,phone,password,ville,quartier,indication,isAdmin,createdAt) 
                            VALUES(?,?,?,?,?,?,0,NOW())'
                        );
                    	$req->execute(array($_POST['pseudo'],$_POST['phone'],sha1($_POST["password"]),htmlspecialchars($_POST["ville"]),htmlspecialchars($_POST["quartier"]),htmlspecialchars($_POST["indication"])));
                    	$req->closeCursor();

						$req = $this->_db->prepare('SELECT id,pseudo,phone,profile,password,ville,quartier,indication,isAdmin,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM users WHERE phone = ?');
						$req->execute(array($_POST["phone"]));
						$_SESSION['user'] = $req->fetch();
                    	$req->closeCursor();
                        header('location:../views/compte.php');
                    }else{
                        $_SESSION["error_phone"] = "Un compte existe déja avec ce numéro de téléphone .";
                    }
				}
			}
		}

        public function updateUser(){
			$errors_number = 0;
            $valide_password = 1;
			if(!empty($_POST['update'])){
				if(empty($_POST["pseudo"]) || !verif_name($_POST["pseudo"])){
					$_SESSION["error_pseudo"]="Donnez un nom qui commence par une lettre,au moins 2 caractères.";
					$errors_number += 1;
				}
				if(empty($_POST["phone"]) || !verif_phone($_POST["phone"])){
					$_SESSION["error_phone"]="Donnez un numéro de téléphone valide pour nous permettre de vous contacter .";
					$errors_number += 1;
				}
                if(empty($_POST["ville"])){
					$_SESSION["error_ville"]="Veuillez remplire ce champ.";
					$errors_number += 1;
				}
                if(empty($_POST["quartier"])){
					$_SESSION["error_quartier"]="Veuillez remplire ce champ.";
					$errors_number += 1;
				}
                if(empty($_POST["indication"])){
					$_SESSION["error_indication"]="Veuillez remplire ce champ.";
					$errors_number += 1;
				}
				if(!empty($_POST["password"]) && !verif_password($_POST["password"])){
					$_SESSION["error_password"]="Un mot de passe doit contenir des majuscules,des chiffres,des minuscules et au moins 6 caractères!";
					$errors_number += 1;
                    $valide_password = 0;
				}
                if(!empty($_POST["confirm_password"]) && !verif_password($_POST["confirm_password"])){
					$_SESSION["error_confirm_password"]="Un mot de passe doit contenir des majuscules,des chiffres,des minuscules et au moins 6 caractères!";
					$errors_number += 1;
				}else{
                    if($valide_password == 1 AND $_POST["password"] != $_POST["confirm_password"]){
                        $_SESSION["error_confirm_password"]="Le mot de passe de confirmation est différent du mot de passe initial.";
                        $errors_number += 1;
                    }
                }
				
				if($errors_number == 0){
                    $req = $this->_db->prepare(
                        'UPDATE users SET pseudo = ?,phone=?,password=?,ville=?,quartier=?,indication=? WHERE id = ?'
                    );

                    if(empty($_POST['password'])){
                        $password = $_SESSION['user']['password'];
                        echo "yes";
                        //(empty($_POST['password']))?$_SESSION['user']['password']:sha1($_POST["password"])
                    }else{
                        $password = sha1($_POST["password"]);
                        echo "no";
                    }

                    $req->execute(array(
                        $_POST['pseudo'],$_POST['phone'],$password,
                        htmlspecialchars($_POST["ville"]),htmlspecialchars($_POST["quartier"]),
                        htmlspecialchars($_POST["indication"]),$_SESSION['user']['id']
                    ));
                    $_SESSION['user'] = $this->getUserById($_SESSION['user']['id']);
                    unset($_POST);
                    
				}
			}
		}

        //function d'ajout de photo de profile
        public function add_profile_picture(){
            if(!empty($_POST['addPict'])){
                if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name'])){
                    $tailMax = 2097152;
                    $extention = array('jpg','jpeg','gif','png');
                    if($_FILES['photo']['size'] <= $tailMax){
                        $file_upload_extension =strtolower(substr(strrchr($_FILES['photo']['name'],'.'), 1));
                        if(in_array($file_upload_extension, $extention)){
                            $article_name_in_the_folder_and_in_db = $_SESSION['user']['id'].'-'.date("Y-m-h-i-s").'.'.$file_upload_extension;
                            $chemin = '../../image/usersProfilesPictures/'.$article_name_in_the_folder_and_in_db;
                            $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
                            if($resultat){
                                $req = $this->_db->prepare('UPDATE users SET profile = ? WHERE id = ?');
                                $req->execute(array($article_name_in_the_folder_and_in_db,$_SESSION['user']['id']));
                            }else{
                                $_SESSION['photo_errors'] = "Il y a eu une erreur lors de l'importation de la photo.";
                            }
                        }else{
                            $_SESSION['photo_errors'] = "La photo de profile doit être au format jpep ,jpg ,gif ou png";
                        }
                    }else{
                        $_SESSION['photo_errors'] ='La taille de la photo doit être au maximun = 2Mo';
                    }
                }else{
                    $_SESSION['photo_errors'] = "veillez choisir une photo de profile";
                }
            }
            
        }

        public function resetPassword($codegenere,$phone){
            $errors_number = 0;
			if(!empty($_POST['changePWD'])){
                if(empty($_POST["validation_code"])){
					$_SESSION["error_validation_code"]="Entrer le code validation.";
					$errors_number += 1;
				}
                if(empty($_POST["new_password"]) || !verif_password($_POST["new_password"])){
					$_SESSION["error_new_password"]="Un mot de passe doit contenir des majuscules,des chiffres,des minuscules et au moins 6 caractères!";
					$errors_number += 1;
				}
				if($errors_number == 0){
                    if($codegenere == $_POST["validation_code"]){
                        $this->changePassword($_POST["new_password"],$phone);
                    }else{
                        $_SESSION['codeValidation'] = generationCodeParrain();
                        $_SESSION["error_validation_code"] = "Donner le bon code de validation.";
                    }
				}
			}
        }

        public function addAdmin(){
			$errors_number = 0;
			if(!empty($_POST['add'])){
				if(empty($_POST["phone"]) || !verif_phone($_POST["phone"])){
					$_SESSION["error_phone"]="Donnez un numéro de téléphone valide .";
					$errors_number += 1;
				}
				
				if($errors_number == 0){
                    $req = $this->_db->prepare('SELECT phone FROM users WHERE phone = ?');
                    $req->execute(array($_POST["phone"]));
                    $exist = $req->rowCount();//si cette variable est egale 0 on inscrit le visteur
                    if($exist == 1){
                        if(!$this->isAdmin($_POST['phone'])){
                            $req = $this->_db->prepare(
                                'UPDATE users SET isAdmin = ? WHERE phone = ?'
                            );
                            $req->execute(array(1,$_POST['phone']));
                            $req->closeCursor();
                            unset($_POST['phone']);
                            $_SESSION["addAdminSuccess"] = "Administrateur ajouté avec succès.";
                        }else{
                            $_SESSION["error_phone"] = "Ce utilisateur est déjà un administrateur.";
                        }
                    	
                    }else{
                        $_SESSION["error_phone"] = "Aucun utilisateur trouvé pour ce numéro .";
                    }
				}
			}
		}


        //chage le mot de passed'un user
        public function changePassword($pwd,$phone){
            $req = $this->_db->prepare('UPDATE users SET password = ? WHERE phone = ?');
            $req->execute(array(sha1($pwd),$phone));
            $_SESSION["success_seting_password"] = "Votre mot de passe a été changé avec succès.";
            unset($_POST);
            if(isset($_SESSION['phoneChangePWD'],$_SESSION['codeValidation'])){
                unset($_SESSION['phoneChangePWD']);
                unset($_SESSION['codeValidation']);
            }
        }

        public function verificationPhoneBeforeChanginPWD(){
            $errors_number = 0;
			if(!empty($_POST['validation'])){
				if(empty($_POST["phone_change_pwd"]) || !verif_phone($_POST["phone_change_pwd"])){
					$_SESSION["error_phone_change_pwd"] = "Donner le numéro de téléphone lors de la création de votre compte.";
					$errors_number += 1;
				}
				if($errors_number == 0){
					$user = $this->getUser($_POST["phone_change_pwd"]);
                    if(empty($user)){
                        $_SESSION["error_phone_change_pwd"] = "Aucun utilisateur n'a été trouvé pour ce numéro";
                    }else{
                        $_SESSION['phoneChangePWD'] = $_POST["phone_change_pwd"];
                        $_SESSION['codeValidation'] = generationCodeParrain();
                        unset($_POST["phone_change_pwd"]);
                    }
                    
				}
			}
            
        }


        /**
         * function de suppression d'un user
         *
         * @param [type] $phone
         */
        public function deleteUserWithPhone($phone){
            $userExisteInfo = $this->userExistWithphone($phone);
            if ($userExisteInfo["existe"]){
                $req = $this->_db->prepare('DELETE FROM users WHERE phone = ?');
                $req->execute(array($phone));
                $req->closeCursor();
            }
            else{
                $_SESSION['suppression_error'] = "Aucun n'utilisateur n'est avec ce numéro de téléphone .";
            }
        }

        /**
         * permet de definir la pagination sur les utilisateur sur
         * elle return un table contenant les utilisateur a affiché sur une page (5/page)
         * et le nombre de page page total sur qu'on va utilisé une boucle pour afficher 
         * les liens en bas en passant la variable page dans l'url
         * @return void
         */
        public function userPagination(){
            $numberByPage = 10;
            $totalUsers = count($this->getAllUsers());
            $totalPages = intval(ceil($totalUsers / $numberByPage));
            if(isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0 AND $_GET["page"] <= $totalPages){
                $pageCourante = intval($_GET["page"]);
            }else{
                $pageCourante = 1;
            }
            $start = ($pageCourante -1) * $numberByPage;
            $reponse = $this->_db->query('SELECT id,pseudo,phone,profile,password,ville,quartier,indication,isAdmin,DATE_FORMAT(createdAt,\'%d/%m/%Y\') AS createdAt FROM users ORDER BY id ASC LIMIT '.$start.','.$numberByPage);
            if($reponse->rowCount() == 0){
                $users = [];
            }else{
                $users = [];
                while ($donnees = $reponse->fetch()){
                    $users[] = $donnees;
                }
            }
            $reponse->closeCursor();
            $pagination["users"] = $users;
            $pagination["totalPage"] = $totalPages;
            $pagination["pageCourante"] = $pageCourante;
            return $pagination; 
        }
    }
    