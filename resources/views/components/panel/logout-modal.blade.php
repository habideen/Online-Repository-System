<!-- Start Logout Modal -->
<div class="modal fade" id="logoutModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Logout?</h5>
        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex">
          <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="100" height="100"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
          <div class="me-auto ms-4 h1">
            Are you sure you want to logout?
          </div>
        </div>

        <div class="d-flex mt-5">
          <a href="/logout" class="btn btn-danger btn-lg">Logout</a>
          <div class="ms-auto">
            <a href="javascript: void(0)" class="btn btn-light btn-lg" data-bs-dismiss="modal">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Logout Modal -->