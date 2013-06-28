<?php
include('db.php');

if(isset($_GET['subject'])) {
    $curr_subject = $_GET['subject'];
} else {
    $curr_subject = 'Crime and law enforcement';
}

$q = "SELECT BillSubject FROM Subjects";
$res = $db->query($q);
if(!$res) {
        echo "$q<br/>";
        echo $db->error."<br/>";
}
$subjects = array();
while($row = $res->fetch_assoc()) {
    $subjects[] = $row['BillSubject'];
}

$q = "SELECT * FROM aggregated_senator WHERE SenatorParty='D' AND BillSubject='$curr_subject' ORDER BY percent_with_party DESC,with_party_votes DESC";
$res = $db->query($q);
if(!$res) {
    echo "$q<br/>";
    echo $db->error."<br/>";
}
$democrats = array();
while($row = $res->fetch_assoc()) {
    $democrats[] = $row;
}

$q= "SELECT * FROM aggregated_senator WHERE SenatorParty='R' AND BillSubject='$curr_subject' ORDER BY percent_with_party DESC,with_party_votes DESC";
$res = $db->query($q);
$republicans = array();
while($row = $res->fetch_assoc()) {
    $republicans[] = $row;
}

?>
<html>
<head>
<link rel="stylesheet" href="static/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="static/bootstrap/css/bootstrap-responsive.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="static/bootstrap/js/bootstrap.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                &nbsp;
            <div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <h1>Senator's Take on Issues</h1>
                <h3>112th Congress (2011-2012)</h3>
            <div>
        </div>
         <div class="row-fluid">
            <div class="span12">
                &nbsp;
            <div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                This application will allow you to view the Senator's stand on various issues.
                Select the issue and it will list the results in tabular form by party. For example, try Foreign trade and international finance,
Transportation and pubic works, or
Crime and Law Enforcement
            <div>
        </div>
         <div class="row-fluid">
            <div class="span12">
                &nbsp;
            <div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <form id="subject_form" action="#" method="GET">
                    Subject:&nbsp;&nbsp;
                    <select class="span3" name="subject" onchange="$('#subject_form').submit();">
                    <?php foreach($subjects as $subject) : ?>
                        <option value="<?php echo $subject;?>" <?php if($subject==$curr_subject) {echo "selected";}?>><?php echo $subject; ?></option>
                    <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="row-fluid">
                    <div class="span12">
                        <h4>Democrat</h4>
                    </div>
                </div>
                <table class="table table-striped table-condensed">
                <tr>
                    <th>Name</th><th>State</th><th>With Party</th><th>Against Party</th><th>% With Party</th>
                </tr>
                <?php foreach($democrats as $democrat): ?>
                 <tr>
                    <td>
                        <?php echo $democrat['SenatorFirstName'].' '.$democrat['SenatorLastName'];?>
                    </td>
                    <td>
                        <?php echo $democrat['SenatorState'];?>
                    </td>
                    <td>
                        <?php echo $democrat['with_party_votes'];?>
                    </td>
                    <td>
                        <?php echo $democrat['against_party_votes'];?>
                    </td>

                    <td>
                        <?php echo number_format($democrat['percent_with_party']*100,2);?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </table>
            </div>
            <div class="span6">
                <div class="row-fluid">
                    <div class="span12">
                        <h4>Republican</h4>
                    </div>
                </div>
                <table class="table table-striped table-condensed">
                 <tr>
                    <th>Name</th><th>State</th><th>With Party</th><th>Against Party</th><th>% With Party</th>
                </tr>
                <?php foreach($republicans as $republican): ?>
                <tr>
                    <td>
                        <?php echo $republican['SenatorFirstName'].' '.$republican['SenatorLastName'];?>
                    </td>
                    <td>
                        <?php echo $republican['SenatorState'];?>
                    </td>
                    <td>
                        <?php echo $republican['with_party_votes'];?>
                    </td>
                    <td>
                        <?php echo $republican['against_party_votes'];?>
                    </td>
                    <td>
                        <?php echo number_format($republican['percent_with_party']*100,2);?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
