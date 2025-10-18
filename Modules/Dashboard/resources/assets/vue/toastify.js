import {toast} from "vue3-toastify";


export function showLoadingToast() {
    return toast.loading('Please Wait ...', {
            position: localStorage.getItem('locale') === 'ar' ? toast.POSITION.TOP_LEFT : toast.POSITION.TOP_RIGHT,
            rtl: localStorage.getItem('locale') === 'ar'
        });
}

export function updateToast(toastId, message, type = toast.TYPE.SUCCESS, onClose = null, onClick = null) {
    toast.update(toastId, {
        render: message,
        type: type,
        onClose: onClose,
        isLoading: false,
        autoClose: true,
        closeButton: true,
        onClick: onClick
    });
}
