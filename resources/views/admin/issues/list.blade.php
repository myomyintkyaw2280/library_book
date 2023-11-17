<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                
    <thead>
    <tr>
        <th data-priority="1">Customer ID</th>
        <th data-priority="2">Customer Name</th>
        <th data-priority="3">Phone Number</th>
        <th data-priority="4">Email Address</th>
        <th data-priority="5">Country Name</th>
        <th data-priority="6">Member Since</th>
        <th data-priority="7">Actions</th>
     
    </tr>
    </thead>
    <tbody>

        @foreach( $customers as $customer)
        <?php 
            $phonecode = $customer->country;
            $phone_code = (!is_null($phonecode))?$phonecode->phone_code:"";
            $country_name = (!is_null($phonecode))?$phonecode->name:"";
        ?>
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td><?php echo $phone_code. $customer->phone; ?></td>
            <td>{{$customer->email}}</td>
            <td>{{$country_name}}</td>
           
            <td>{{custom_date_format($customer->created_at)}}</td>
            <td>
                <a href="{{route('customers.show', $customer->id)}}" class="btn btn-primary btn-sm "><i class='fa fa-eye'></i> View</a>
                <a href="#edit{{$customer->id}}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Edit</a>
                <a href="#delete{{$customer->id}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a>
            </td>
        </tr>
        @endforeach
   
    </tbody>
</table>