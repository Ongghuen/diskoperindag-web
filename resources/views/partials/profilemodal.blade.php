<div class="modal fade" id="profileModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti password</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="/change-password/{{ Auth::User()->id }}" method="post">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>


                        <?php
                        
                        $nomer = 1;
                        
                        ?>

                        @foreach ($errors->all() as $error)
                            <li>{{ $nomer++ }}. {{ $error }}</li>
                        @endforeach
                    </div>
                @endif
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password lama</label>
                        <div class="input-group">
                          <input name="old_password" type="password" class="form-control input-default" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Password baru</label>
                        <div class="input-group">
                          <input name="new_password" type="password" class="form-control input-default" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Komfirmasi password baru</label>
                        <div class="input-group">
                          <input name="new_password_confirmation" type="password" class="form-control input-default" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
