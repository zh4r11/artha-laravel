// import 'bootstrap/dist/css/bootstrap.min.css';
// import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
// import 'toastr/build/toastr.min.css';
// import 'sweetalert2/dist/sweetalert2.min.css';

import $ from "jquery";
import "./bootstrap";
// import "datatables";
// import "datatables.net";
// import "datatables.net-bs4";
// import "datatables.net-select-bs4";
// import "bootstrap-social";
import Swal from "sweetalert2";
import "toastr/build/toastr.min.css";
import toastr from "toastr";

// window.$ = window.jQuery = $;
toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};
window.Swal = Swal;
window.toastr = toastr;