<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="jspdf.debug.js"></script>
</head>

<body>
    <?php
    require 'controllers/student.controllers.php';
    $getStudentControllers = new studentControllers();
    $data_student = $getStudentControllers->getStudent();
    /******************************************************************* */
    $getCourseControllers = new studentControllers();
    $data_course = $getCourseControllers->getCourse();
    ?>
    <form method="post">
        <div class="form-group">
            <label for="">Estudiante</label>
            <select name="studentId" class="form-control">
                <?php
                if (mysqli_num_rows($data_student) > 0) {
                    while($row = mysqli_fetch_assoc($data_student)) {
                       ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name_student'] ?></option>
                <?php
                    }
                 }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Cursos</label>
            <select name="courseId" class="form-control">
                <?php
                if (mysqli_num_rows($data_course) > 0) {
                    while($row = mysqli_fetch_assoc($data_course)) {
                       ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name_course'] ?></option>
                <?php
                    }
                 }
                ?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Vista previa</button>
        </div>

    </form>
    <!-- <div id="pdf">Hello world</div> -->
    <?php
        $stundetControllers = new studentControllers();
        $data_studentCourse = $stundetControllers->getStudentCourse();
        if(isset($data_studentCourse)){
            $data = $data_studentCourse['resp'];
        }
        $name_student = "";
        $name_course = "";
        if(isset($data)){
            //$doc->getElementById('students')
            $student = $data['student'];
            if (mysqli_num_rows($student) > 0) {
                while($row = mysqli_fetch_assoc($student)) {
                    $name_student = $row["name_student"] . ' ' . $row['last_name'];
                }
            }
            $course = $data['course'];
            if (mysqli_num_rows($course) > 0) {
                while($row = mysqli_fetch_assoc($course)) {
                    $name_course = $row["name_course"];
                }
            }
        }
    ?>

    <?php

if(isset($data)){
    ?>
    <div>
        <div class="content-body" id="pdf">
            <h1 class="title">Centificado</h1>
            <div class="logo-content">
                <img src="image/logo.png">
            </div>
            <p>Confiere este certificado a:</p>
            <h1 class="name-student"><?php echo $name_student; ?></h1>
            <p>por haber concluido y aprobado el:</p>
            <h3 class="text-course">el curso de: <?php echo $name_course; ?></h3>
        </div>
    </div>
    <div>
        <form method="post">
            <input type="hidden" name="studentId"
                value="<?php echo $data_studentCourse['data_certificate']['studentId']; ?>">
            <input type="hidden" name="courseId"
                value="<?php echo $data_studentCourse['data_certificate']['courseId']; ?>">
            <input type="hidden" name="name_student" value="<?php echo $name_student; ?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Generar</button>
        </form>
    </div>

    <?php
}

?>

    <?php
$generateControllers = new studentControllers();
$data_generate = $generateControllers->generateSudent();

if(isset($data_generate)){
    ?>
    <script>
    function download() {
        var options = {};
        var pdf = new jsPDF('l', 'pt', 'a4');
        var content = document.getElementById('pdf')
        var name = document.getElementById('namePdf')
        var name_student = '<?php echo $name_student; ?>'
        var pathToFile = `certificado_${name_student}`
        pdf.addHTML(content, 15, 15, options, function() {
            // pdf.save('certificado_'+name_student);
            pdf.output('save', pathToFile);
        });
        // pdf.save('informe.pdf');
    }
    download();
    </script>
    <?php
}

?>



    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>