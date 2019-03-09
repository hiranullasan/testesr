<?php
include "MysqlDatabase.php";
include "Student.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
$edit_id=$_GET['edit'];
$student  = new Student();
$student->setDebug(1);
$students_list   = $student->stdentList($edit_id);
if(!empty($students_list)){
	$students_list = $students_list[0];
}
if(isset($_POST['update'])){
	$_POST["id"]=$edit_id;
	
	$up=$student->updateStudent($_POST); 

}
?>
<!DOCTYPE html>
<head><b><center>STUDENT REGISTRATION</center></b>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    
    $(function() {
 
  $("form[name='form']").validate({
    
    rules: {
          name:{
            required:true
        },
        age: {
            required: true
        },
        address:{
            required:true
        }
    },
    messages: {
      name: { 
          required:"Please enter your name"
      },
      age: {
          required:"Please enter your age"
      },
      address:{
          required:"address required"
      }
     
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
    $("#submit").click(function() {     
      if($('input[type=radio][name=gender]:checked').length == 0)
      {
         alert("Please select atleast one gender");
 
         return false;
      }
      else
      {
          //alert("radio button selected value: ");
      }      
    });
});
</script>
</head>
	<body>
		<br><br>
		<form action="edit.php?edit= <?php echo $edit_id; ?>" method="POST" name="form" id="form">
			
			<table align="center" cellpadding="12">
				<tr>
					<td colspan="2"><b>Name:</b></td>
					<td colspan="2"><input type = "text" name ="name" id="name" size="10" value="<?php echo $students_list['name']; ?>""></td>
				</tr>
				<tr>
					<td colspan="2"><b>Age :</b></td>
					<td colspan="2"><input type = "text" name ="age" size="10" value="<?php echo $students_list['age']; ?>"></td>
				</tr>
				<tr>
					<td colspan="2"><b>Sex :</b></td>
					<td colspan="2"><input type ="radio" name="gender" value="male">Male<input type ="radio" name="gender" value="female">Female</td>
				</tr>
				<tr>
					<td colspan="2"><b>City :</b></td>
					<td colspan="2"><select name="city" >
						<option value="Kasargod">Kasargod</option>
						<option value="Kannur">Kannur</option>
						<option value="Kozhikod">Kozhikod</option>
						<option value="Malapuram">Malapuram</option>
					</select></td>
				</tr>
				<tr>
					<td colspan="2"><b>Address :</b></td>
					<td> <textarea name="address" rows="10" cols="20" ><?php echo $students_list['address']; ?></textarea></td>
				</tr>
				<tr>
					<td colspan="2"><b>Qualification :</b></td> 
					<td colspan="2"><select name="qualification" multiple>
						<option value="mca">MCA</option>
						<option value="mba">MBA</option>
						<option value="bsc">Bsc</option>
						<option value="bca">BCA</option>
					</select></td>
				</tr>
				<tr> 
					<td colspan="2"><b>Grade :</b></td>
					<td colspan="2"><select name="grade" >
						<option value="a">A</option>
						<option value="b">B</option>
						<option value="c">C</option>
						<option value="d">D</option>
					</select></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="update" value="Register" ></td>
				</tr>	
			</table>
		</form>
</body>

