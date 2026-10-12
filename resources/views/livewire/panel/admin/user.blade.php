<main class="main-content">

	<div class="card">
            <div class="card-body">
				<div class="table overflow-auto" tabindex="8">
					<div class="form-group row ">
						<label class="col-sm-2 col-form-label">عنوان جستجو</label>
                        <div class="col-sm-8">
							<input type="text" class="form-control text-left " dir="rtl" wire:model="search">
						</div>
                        <button type="button" class="btn btn-success m-2"  >
                          جستجو
                         </button>
                         <button type="button" class="btn btn-primary  m-2" data-toggle="modal" data-target="#createUserModal">
                          افزودن کاربر
                         </button>
					</div>
					<table class="table table-striped table-hover">
						<thead class="thead-light">
						<tr>
							<th class="text-center align-middle text-primary">ردیف</th>
							<th class="text-center align-middle text-primary">نام و نام خانوادگی</th>
							<th class="text-center align-middle text-primary">ایمیل</th>
							<th class="text-center align-middle text-primary">موبایل</th>
							<th class="text-center align-middle text-primary">نقش های کاربر</th>
							<th class="text-center align-middle text-primary"> وضعیت</th>
							<th class="text-center align-middle text-primary">ویرایش</th>
							<th class="text-center align-middle text-primary">تاریخ ایجاد</th>
						</tr>
						</thead>
						<tbody>
							@forelse ($users as $index =>$user )
                                <tr>
								<td class="text-center align-middle">{{  $users->firstItem() }}</td>
								<td class="text-center align-middle">{{  $user->name  ?? $user->user_name }}</td>
								<td class="text-center align-middle">{{  $user->email }}</td>
                                <td class="text-center align-middle">{{  $user->mobile  ?? '-'}}</td>
								<td class="text-center align-middle">
									<a class="btn btn-outline-info" href="#">
										نقش های کاربر
									</a>
								</td>
								<td class="text-center align-middle">
										<span class="cursor-pointer badge badge-success">فعال</span>
								</td>
								<td class="text-center align-middle">
									<a class="btn btn-outline-info" href="#">
										ویرایش
									</a>
								</td>
								<td class="text-center align-middle">{{  verta($user->created_at) }}</td>
							</tr>
                            @empty
                            <tr>
								<td class="text-center align-middle"> کاربری  یافت نشد </td>
							</tr>
                            @endforelse
					</table>
					<div style="margin: 40px !important;"
						 class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
					</div>
				</div>
            </div>
        </div>
{{-- مودال --}}
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ایجاد کاربر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form wire:submit="addUser"  enctype="multipart/form-data">
                 @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">نام و نام خانوادگی</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" wire:model="name" dir="rtl">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label"> نام کاربری  </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " wire:model="user_name" dir="rtl">
                            @error('user_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ایمیل</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" wire:model="email" dir="rtl">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">موبایل</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" wire:model="mobile" dir="rtl">
                            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">پسورد</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" wire:model="password" dir="rtl">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">تکرار پسوورد </label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" class="form-control" wire:model="password_confirmation" dir="rtl">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">آپلود عکس</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" wire:model="avatar">
                            @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="submit" class="btn btn-success">
                        <i class="ti-check-box m-r-5"></i> ذخیره
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
	</main>


