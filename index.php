<?php 
include ("conn.php");



session_start();
if (!empty($_POST)){
	if (isset($_POST['submission_id'])){
		if(isset($_POST['article_name'])){
			if(isset($_POST['contact'])){

		$submission_id = strtolower(trim(($_POST['submission_id'])));
		$article_name = strtolower(trim(($_POST['article_name'])));
		$contact = strtolower(trim(($_POST['contact'])));


		$uploaddir = 'upload/';
		define ('SITE_ROOT', realpath(dirname(__FILE__)));
		$uploadfile = SITE_ROOT.'/upload/'. basename($_FILES['upload1']['name']);
		$uploadfile=str_replace(' ','|',$uploadfile);
		$upload1 = $uploadfile;


		if (move_uploaded_file($_FILES['upload1']['tmp_name'], $uploadfile)) {
		    echo "";
		} else {
		    echo "Possible 1 file upload attack!\n";
		}

			$uploaddir = 'upload/';
		define ('SITE_ROOT', realpath(dirname(__FILE__)));
		$uploadfile = SITE_ROOT.'/upload/'. basename($_FILES['upload2']['name']);
		$uploadfile=str_replace(' ','|',$uploadfile);
		$upload2 = $uploadfile;


		if (move_uploaded_file($_FILES['upload2']['tmp_name'], $uploadfile)) {
		    echo "";
		} else {
		    echo "Possible 2 file upload attack!\n";
		}


		$sql=("INSERT INTO student_information(submission_id,article_name,contact, upload1,upload2) VALUES(?,?,?,?,?)");
		$insert =$conn->prepare($sql);
		$insert->bind_param('sssss',$submission_id,$article_name,$contact,$upload1,$upload2);
		
    

	if($insert->execute()){

		
		
			
					require_once('PHPMailer/class.phpmailer.php');



					$bodytext = "Name and Affiliation: ".$submission_id."\n"."Title of the manuscript: ".$article_name."\n"."Contact Email: ".$contact;
					$email = new PHPMailer();
					$email->From      = "anonymous@anonymous.com";
					$email->FromName  = $submission_id;
					$email->Subject   = 'Submission with attachment';
					$email->Body      = $bodytext;
					$email->AddAddress( 'jistudents@outlook.com' );
					$email->addCC('manhero96@gmail.com');

					//$file_to_attach = '/upload/file.txt';

					if (!$email->AddAttachment($upload1)) {
					    echo "File 1 is not attached";
					}

					if (!$email->AddAttachment($upload2)) {
					    echo "File 2 is not attached";
					}

					else {

					if(!$email->send()) {
					    echo 'Message could not be sent.';

					    
					} else { ?>
					     <div style="color:#660000">Your manuscript has been successfully submitted.<br>The editor will contact you in about 6 to 8 weeks with reviews. Please contact us if you do not hear from us in eight weeks or so.<br>
Thank you for your interest in the Journal of International Students!</div>   <?php
					}
					}


		}
		else {
			echo "Not sucess";
		}



			
			}}}}








?>





<html>
<head>
	<title>Submission From</title>
</head>
<body>
	<h2>Submission Form</h2>

<form action="index.php" method="POST" enctype="multipart/form-data" >
	<div class="field">
			<label for="submission_id"> Your Name and Affiliation: </label>
			<input type="text" name="submission_id" id="submission_id" autocomplete="off">
		
	</div>


	<div class="field">
			<label for="article_name"> Title of the Manuscript: </label>
			<input type="text" name="article_name" id="article_name" autocomplete="off">
	</div>

	<div class="field">
			<label for="contact"> Contact Email: </label>
			<input type="text" name="contact" id="contact" autocomplete="off">
	</div>	

	<div class="info">
		<h3>Directions:</h3>
		<h4>Submit two copies of manuscripts-one without author information, another with author information. </h4>
		<ul>

			<li>Copy 1 (for blind review): Main document file with manuscript title, abstract, keywords, main text, references, figure, and table [all as a ONE file]. Authors must avoid self-identification in the text or references of the manuscript.</li>
			
			<li>Copy 2 (for editors): Manuscript title, abstract, author's affiliation, contact information, and any extra files such as supplemental files or author biographical notes.
			</li>
			</ul>
Author Submission Check Form: All authors are required to complete this form, click <a href="https://docs.google.com/forms/d/19ZnLNPXHn_9B5tvWexRWzb6eMS726yMC-p13HOpqhPs/viewform" target="_blank">Here</a>  to fill it out.
		
		<br>
		<br>
		For more information, visit: <a href="http://jistudents.org/submission-guidelines/" target="_blank">http://jistudents.org/submission-guidelines/</a>
	</div><br>
	<h3>Upload Paper File [Microsoft Word .doc/.docx]</h3>

	<div>
		(Copy 1)
		<input type ="file" name="upload1"/>
	</div>

	<div>
		(Copy 2)
		<input type ="file" name="upload2"/>
	</div>
	<br>
	<br>
	<div>
			<input type="submit"  value= "Submit" >		
	</div>	
</form>	
</body>
</html>