import axios from 'axios';
import { showLoadingToast, updateToast } from './toastify';

export async function callRequest({
  url,
  data = {},
  method = 'GET',
  onSuccess = () => {},
  onError = () => {},
  afterRequest = () => {},
}) {
    const toastId = showLoadingToast();

    try {
        const response = await axios.request({
            method,
            url,
            data,
        });

        updateToast(toastId, 'Success!', 'success');
        onSuccess(response.data);
    } catch (error) {
        // backend error
        if (error.response && axios.isAxiosError(error)) {
            updateToast(toastId, error.response.data.message || 'Something went wrong.', 'error');
            onError(error);
        } else {
            // internal error before backend
            updateToast(toastId, error.message || 'Network Error', 'error');
            throw error;
        }
    }

    afterRequest()
}
