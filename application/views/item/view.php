
<table id="datatable" class="table table-striped table-bordered" width="100%" cellspacing="0">
    <tr>
        <th> <?php echo $this->lang->line('name')?></th>
        <td><?php echo $viewdetails->SALUTATION_NAME.' '.$viewdetails->FULL_NAME ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('father_name')?> </th>
        <td><?php echo $viewdetails->FATHER_NAME ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('mother_name')?> </th>
        <td><?php echo $viewdetails->MOTHER_NAME ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('gender')?></th>
        <td>
            <?php
            switch ($viewdetails->GENDER) {
                case "M":
                    echo "Male";
                    break;
                case "F":
                    echo "Female";
                    break;
                default:
                    echo "Others";
            }
            ?>
        </td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('marital_status')?> </th>
        <td><?php echo $viewdetails->MARITAL_NAME; ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('religion')?></th>
        <td><?php echo $viewdetails->RELIGION_NAME; ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('phone')?> </th>
        <td><?php echo $viewdetails->MOBILE ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('nid')?> </th>
        <td><?php echo $viewdetails->NID ?></td>
    </tr>
    <tr>
        <th>Joining Date</th>
        <td><?php echo $viewdetails->JOINING_DT ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('email')?> </th>
        <td><?php echo $viewdetails->EMAIL ?></td>
    </tr>

    <tr>
        <th><?php echo $this->lang->line('org')?> </th>
        <td><?php echo $viewdetails->ORG_NAME ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('dept')?> </th>
        <td><?php echo $viewdetails->DEPT_NAME ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('designation')?> </th>
        <td><?php echo $viewdetails->DESIG_NAME ?></td>
    </tr>
    <tr>
        <th><?php echo $this->lang->line('rank')?> </th>
        <td><?php echo $viewdetails->RANK_NAME ?></td>
    </tr>
</table>


