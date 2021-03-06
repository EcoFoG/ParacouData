<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand">Paracou-Ex Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'admin/list_users' ?>">User list</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url().'admin/list_requests' ?>">Request list<span class="sr-only">(current)</span></a>
        </li>
    </ul>
    <form class="navbar-text form-inline">
        <a href="<?php echo base_url().'main/?Plot[]=6' ?>">Back to homepage</a>
    </form>
  </div>
</nav>
<script type="text/javascript">
$(document).ready(function() {
    $('#request-table').DataTable();
} );
</script>
<form method="get">
    <button class="m-2 btn btn-primary" type="submit" name="csv" />
    Export to CSV  <i class="fas fa-share"></i>
    </button>
</form>
<table id="request-table" class="table table-bordered table-stripped">
    <thead>
        <th>Id</th>
        <th>E-mail</th>
        <th>Full name</th>
        <th>Affiliation</th>
        <th>Title Research</th>
        <th>Desired expiration</th>
        <th>Accepted</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php

        foreach($requests as $value){

            $userAcceptor = $user_model->getUserInfo($value->accepted_by);

            if ($value->accepted === "Declined") {
                $accepted = $value->accepted." by ".$userAcceptor->first_name ;
                $class = " class = \"table-danger\" ";
            } else if (isset($value->accepted)) {
                $accepted = $value->accepted." by ".$userAcceptor->first_name ;
                $class = " class = \"table-success\" ";
            } else {
                $accepted = "Not accepted yet";
                $class = " class = \"table-secondary\" ";
            }
            echo "<tr>";
            echo "<td>$value->id</td>";
            echo "<td>$value->email</td>";
            echo "<td>$value->firstname $value->lastname</td>";
            echo "<td>$value->affiliation</td>";
            echo "<td>$value->title_research</td>";
            echo "<td>$value->timeline</td>";
            echo "<td$class>$accepted</td>";
            echo "<td><a class=\"btn-sm btn-primary\" href=\"".base_url()."admin/show_request/$value->id\">Show <i class=\"fas fa-eye\"></i></a>";
            echo "</tr>";
        }?>
    </tbody>
</table>
