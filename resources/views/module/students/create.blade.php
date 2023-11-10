<div class="card-body">
    <form action="{{ route('student.store.modal') }}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label>@translate(Full Name) <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="@translate(Fill name)" required>
        </div>

        <div class="form-group">
            <label>@translate(Email address) <span class="text-danger">*</span></label>
            <input class="form-control" name="email" placeholder="@translate(Email address)" required>
        </div>

        <div class="form-group">
            <label>@translate(Password) <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="password" placeholder="@translate(Password)" required>
        </div>

        <div class="form-group">
            <label>@translate(Confirm password) <span class="text-danger">*</span></label>
            <input class="form-control" type="password" name="confirmed" placeholder="@translate(Confirm password)" required>
        </div>
       
      
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>



