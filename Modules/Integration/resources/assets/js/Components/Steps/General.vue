<template>
  <!--begin::Step 1-->
  <div class="current" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
      <!--begin::Heading-->
      <div class="pb-10 pb-lg-15">
        <!--begin::Title-->
        <h2 class="fw-bolder d-flex align-items-center text-dark">Basic Client info
          <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Basic Client info" aria-label="Basic Client info"></i>
        </h2>
        <!--end::Title-->
        <!--begin::Notice-->
        <div class="text-muted fw-bold fs-6"> Provide the basic details about this client such as name.
          These settings help identify the client within your system.
        </div>
        <!--end::Notice-->
      </div>
      <!--end::Heading-->
      <!--begin::Input group-->
      <div class="fv-row fv-plugins-icon-container">
        <!--begin::Row-->
        <div class="row">
          <!--begin::Col-->
          <div class="col-lg-12">
            <div class="fv-row mb-10">
              <label class="required form-label">Client Name</label>
              <input type="text" class="form-control" v-model="form.name" placeholder="Enter client name"/>
              <div class="invalid-feedback d-block" v-if="v$.name.$invalid && v$.name.$dirty">
                {{ v$.name.$errors[0].$message }}
              </div>
            </div>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
      </div>
      <!--end::Input group-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Step 1-->

  <div class="d-flex flex-stack pt-10">
    <div class="mr-2"></div>
    <div>
      <button type="button" class="btn btn-lg btn-primary" @click="submit">Save & Continue</button>
    </div>
  </div>
</template>

<script setup>
import {ref, defineEmits, computed} from "vue";
import { useVuelidate } from '@vuelidate/core'
import {helpers, minLength, required} from '@vuelidate/validators'
// import { showLoadingToast, updateToast } from '@dashboard/toastify';
import { callRequest } from '@dashboard/axios';

const emit = defineEmits(['success']);

const rules = computed(() => ({
  name: {
    // required: helpers.withMessage('abc', required),
    required,
    minLengthValue: minLength(2),
  }
}))

const form = ref({
  name: ''
});

// External results will hold any validation from the backend side
// merge laravel validation result with the vuelidate error bag.
let $externalResults  = ref({});
const v$ = useVuelidate(rules, form, {$externalResults});

async function submit() {
  v$.value.$clearExternalResults()

  // before submit check vuelidate error bag.
  if (! await v$.value.$validate()) {
    return;
  }

  callRequest({
    url: route('dashboard.integrations.general.save'),
    method: 'POST',
    data: form.value,
    onSuccess: (res) => emit('success', {
      integrationId: res.data.id
    }),
    onError: (error) => {
      if(error.response.status === 422)
        $externalResults.value = error.response.data.errors
    }
  });
}
</script>