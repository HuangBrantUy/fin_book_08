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
            <h1 class="h3 mb-2 text-gray-800">Category Management</h1>
            <p class="mb-4">Mange your sources of income and expenses here.</p>
            <div class="card shadow mb-4">
               <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">My Categories</h6>
                  <div>
                     <button id="editBtn" type="button" class="btn btn-secondary" ><i class="far fa-edit"></i> Edit</button>
                     <button id="closeBtn" class="btn btn-danger" style="display: none;"><i class="fas fa-times"></i> Cancel</button>
                     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Create"><i class="fas fa-plus"></i> Create</button>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover" id="categoryTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th>Description</th>
                              <th>Type</th>
                              <th class="optionRow" style="display: none;"></th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($categories as $category)
                           <tr>
                              <td>{{$category->description}}</td>
                              <td>{{$category->type}}</td>
                              <td class="optionRow" style="display:none;"> <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit"><i class="far fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Delete</button></td>
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
<!-- Create Modal -->
<div class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="/account/category" method="POST">
               @csrf
               <div class="form-group">
                  <label for="desc">Description:  </label>
                  <input type="text" name="description" id="desc" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="type">Type:</label>
                  <select name="type" id="type" class="form-control" required>
                     <option selected disabled>Select Type</option>
                     <option value="Expense">Expense</option>
                     <option value="Income">Income</option>
                  </select>
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="submit" class="btn btn-success" value="Create">
         </div>
      </div>
      </form>
   </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="">
               <div class="form-group">
                  <label for="desc">Desctiption:  </label>
                  <input type="text" name="" id="desc" class="form-control">
               </div>
               <div class="form-group">
                  <label for="type">Type:</label>
                  <select name="" id="type" class="form-control">
                     <option selected disabled>Select Type</option>
                     <option value="Expense">Expense</option>
                     <option value="Income">Income</option>
                  </select>
               </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <input type="submit" name="" id="" class="btn btn-primary" value="Edit">
         </div>
      </div>
      </form>
   </div>
</div>
<!-- End -->

@endsection


