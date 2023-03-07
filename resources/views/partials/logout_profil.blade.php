<div class="modal fade" id="profilemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="forms-sample">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama</label>
                        <input disabled type="text" value="" class="form-control" id="exampleInputUsername1"
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input disabled type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>

                </form>

                <div class="modal-footer">
                    {{-- <button class="btn btn-primary me-2">Submit</button> --}}
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Logout</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="forms-sample">
                    <h5>Anda Yakin Mau Keluar ? </h5>

                </form>

                <div class="modal-footer">
                    <a href="/logout" class="btn btn-danger me-2">Yes</a>
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</div>
