@extends('layouts.accountlayout')
@section('content')
<!-- Start -->

   
   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
         <!-- Topbar -->
         @include('interfaces.topbar')
         <!-- End of Topbar -->
         <!-- Begin Page Content -->
         <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Ledger Report</h1>
            <p class="mb-4">Record and manage all of your expenses and incomes here!</p>
            <div class="card shadow mb-4">
               <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">My Ledgers</h6>
                  <div>
                     <button id="closeBtn" class="btn btn-danger" style="display: none;"><i class="fas fa-times"></i> Cancel</button>
                     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Create"><i class="fas fa-plus"></i> Add</button>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover" id="ledgerTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th>Date</th>
                              <th>Description</th>
                              <th>Category</th>
                              <th>Amount</th>
                              <th class="optionRow" style="display: none;"></th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($data['ledgers'] as $ledger)
                           <tr>
                              <td>{{$ledger->date}}</td>
                              <td>{{$ledger->description}}</td>
                              <td>{{$ledger->category}}</td>
                              @foreach($data['categories'] as $category)
                                @if($category->description == $ledger->category)
                                    @if($category->type == 'Income')
                                    <td class="text-success">₱{{$ledger->amount}}</td>
                                    @break
                                    @else
                                    <td class="text-danger">(₱{{$ledger->amount}})</td>
                                    @break
                                    @endif
                                @endif                               
                              @endforeach
                              <td width="80px"> <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-{{$ledger->id}}"><i class="fas fa-times"></i> Delete</button> </td>                             
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
         <div class="container my-auto">
            <div class="copyright text-center my-auto">
               <span>Copyright &copy; WebDev2 2020</span>
            </div>
         </div>
      </footer>
      <!-- End of Footer -->
   </div>
   <!-- End of Content Wrapper -->


<!-- End -->
<!-- Create Modal -->
<div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Ledger</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="/account/ledger" method="POST">
               @csrf
               <div class="form-group">
                  <label for="date">Date:  </label>
                  <input type="date" name="date" id="date" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="desc">Descrption:  </label>
                  <input type="text" name="description" id="desc" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="cate">Category:</label>
                  <select name="category" id="category" class="form-control" required>
                     <option selected disabled>Select Category</option>
                     @foreach($data['categories'] as $category)
                     <option value="{{$category->description}}">{{$category->description}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label for="amt">Amount:  </label>
                  <input type="number" name="amount" id="amt" class="form-control" min="1" required>
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="submit"class="btn btn-success" value="Create">
         </div>
      </div>
      </form>
   </div>
</div>
<!-- Confirm Modal -->
@foreach($data['ledgers'] as $ledger)
<div class="modal fade" id="confirm-{{$ledger->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>Are you sure you want to delete this ledger from {{$ledger->date}}?</p>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <form action="/account/ledger/{{$ledger->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"> Delete</button>
         </form>
         </div>
      </div>
      </form>
   </div>
</div>
@endforeach
@endsection

@section('scriptLedger')
<script>
   $(document).ready(function() {
      $('#ledgerTable').DataTable({
          ordering: false,
          lengthMenu:[[5,10,25,50,-1],[5,10,25,50,'All']],
          searching: false
      });    
   });
   $('#editBtn').click(function(){
       $('#closeBtn').show();
       $('#editBtn').hide();
       $('.optionRow').show();
   });
   $('#closeBtn').click(function(){
       $('#closeBtn').hide();
       $('#editBtn').show();
       $('.optionRow').hide();
   });

   var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;       
document.getElementById("date").value = today;
</script>
@endsection