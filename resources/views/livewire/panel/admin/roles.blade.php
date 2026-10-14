 <!-- begin::main content -->
    <main class="main-content">
        <div class="row">
            {{--  @if(Session::has('message'))
                <div class="alert alert-info">
                    <div>{{session('message')}}</div>
                </div>
            @endif  --}}
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">اتصال کاربر به نقش</h6>
                    <form role="form" wire:submit="saveRoles">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#" role="tab">نقش های کاربر</a>
                                           @foreach ($roles as $role)
                                            <div class="form-check d-flex align-items-center mb-2">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="role-{{ $role->id }}"
                                                    value="{{ $role->name }}"
                                                    wire:model="selectedRoles"
                                                >
                                                <label class="form-check-label mr-2" for="role-{{ $role->id }}">
                                                    {{ \App\Enums\RolesEnum::tryFrom($role->name)?->label() ?? $role->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"  > ثبت</button>
                              <a href="{{  route('users') }}">
                            <button type="button" class="btn btn-info"    > تایید و بازگشت </button>
                              </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- end::main content -->


