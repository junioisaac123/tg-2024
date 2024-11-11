import "./bootstrap";

import Alpine from "alpinejs";
import Swal from "sweetalert2";

window.Swal = Swal;
window.SwalFCC = (...args) => {
    const customClass = {
        popup: "bg-white dark:bg-gray-800 text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg p-6",
        title: "text-2xl font-bold mb-4",
        content: "text-lg mb-4",
        confirmButton:
            "bg-blue-500 text-white hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-500 font-medium rounded-lg py-2 px-4 focus:outline-none",
        cancelButton:
            "bg-gray-200 text-gray-700 hover:bg-gray-300 focus:ring-4 focus:ring-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:focus:ring-gray-500 font-medium rounded-lg py-2 px-4 focus:outline-none",
    };
    const mixed = {
        customClass: customClass,
        ...(args[0] || {}),
    };
    return Swal.fire(mixed);
};


window.Alpine = Alpine;

Alpine.start();
