<template>
  <!--begin::Step 1-->
  <div class="current" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
      <!--begin::Heading-->
      <div class="pb-10 pb-lg-15">
        <!--begin::Title-->
        <h2 class="fw-bolder d-flex align-items-center text-dark">Master Database Connection
<!--          <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Basic Client info" aria-label="Basic Client info"></i>-->
        </h2>
        <!--end::Title-->
        <!--begin::Notice-->
        <div class="text-muted fw-bold fs-6"> Provide the database credentials used to access the client's master database.
          You can test the connection before saving to ensure it's valid.
        </div>
        <!--end::Notice-->
      </div>
      <!--end::Heading-->
      <!--begin::Input group-->
      <div class="fv-row fv-plugins-icon-container">
        <!--begin::Row-->
        <div class="row">

          <!-- begin::Database Type -->
          <div class="mb-5 fv-row">
            <label class="required form-label">Database Type</label>
            <select class="form-select" v-model="form.db_type">
              <option value="mysql">MySQL</option>
              <option value="mongodb">MongoDB</option>
            </select>
            <div class="invalid-feedback d-block" v-if="v$.db_type.$invalid && v$.db_type.$dirty">{{ v$.db_type.$errors[0].$message }}</div>
          </div>
          <!-- end::Database Type -->

          <!-- begin:: DB Host -->
          <div class="col-lg-12">
            <div class="mb-5 fv-row">
              <label class="required form-label">Database Host</label>
              <input type="text" class="form-control" v-model="form.db_host" placeholder="e.g., 127.0.0.1"/>
              <div class="invalid-feedback d-block" v-if="v$.db_host.$invalid && v$.db_host.$dirty">{{ v$.db_host.$errors[0].$message }}</div>
            </div>
          </div>
          <!-- end:: DB Host -->

          <!-- begin::DB Port -->
          <div class="col-lg-6">
            <div class="mb-5 fv-row">
              <label class="required form-label">Port</label>
              <input type="number" class="form-control" v-model="form.db_port" placeholder="e.g., 3306"/>
              <div class="invalid-feedback d-block" v-if="v$.db_port.$invalid && v$.db_port.$dirty">{{ v$.db_port.$errors[0].$message }}</div>
            </div>
          </div>
          <!-- end::DB Port -->

          <!-- begin::DB Name -->
          <div class="col-lg-6">
            <div class="mb-5 fv-row">
              <label class="required form-label">Database Name</label>
              <input type="text" class="form-control" v-model="form.db_name" placeholder="Enter database name"/>
              <div class="invalid-feedback d-block" v-if="v$.db_name.$invalid && v$.db_name.$dirty">{{ v$.db_name.$errors[0].$message }}</div>
            </div>
          </div>
          <!-- end::DB Name -->

          <!-- begin::Username -->
          <div class="col-lg-6">
            <div class="mb-5 fv-row">
              <label class="required form-label">Username</label>
              <input type="text" class="form-control" v-model="form.db_username" placeholder="Enter database user"/>
              <div class="invalid-feedback d-block" v-if="v$.db_username.$invalid && v$.db_username.$dirty">{{ v$.db_username.$errors[0].$message }}</div>
            </div>
          </div>
          <!-- end::Username -->

          <!-- begin::Password -->
          <div class="col-lg-6">
            <div class="mb-5 fv-row">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" v-model="form.db_password" placeholder="Enter password"/>
              <div class="invalid-feedback d-block" v-if="v$.db_password.$invalid && v$.db_password.$dirty">{{ v$.db_password.$errors[0].$message }}</div>
            </div>
          </div>
          <!-- end::Password -->
        </div>
        <!--end::Row-->
      </div>
      <!--end::Input group-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Step 1-->

  <div class="d-flex flex-stack pt-10">
    <!--  Save Form & Continue   -->
    <div class="mr-2"></div>
    <div>
      <!-- Test Connection Button -->
      <button type="button" class="btn-lg btn-secondary" @click="testConnection" :disabled="testing">
        <!-- Spinner -->
        <span v-if="testing" class="spinner-border spinner-border-sm align-middle me-2"></span>
        <!-- Icon + Label -->
        <span><i class="fas fa-plug me-2"></i>Test Connection</span>
      </button>
      <!-- Test Connection Button -->

      <button type="button" class="btn btn-lg btn-primary" :disabled="testing" @click="submit">Save & Continue</button>
    </div>
  </div>
</template>

<script setup>
import {ref, defineEmits, computed, watch, inject} from "vue";
import { useVuelidate } from '@vuelidate/core'
import { required, numeric, minValue, maxValue, helpers} from '@vuelidate/validators'
import { oneOf } from '@dashboard/validations'
import { callRequest } from '@dashboard/axios';

const integrationData = inject('integrationData')

const testing = ref(false)
const emit = defineEmits(['success']);
const rules = computed(() => ({
  db_type: { required, oneOf: oneOf(['mysql', 'mongodb']) },
  db_host: { required },
  db_port: {
    required,
    numeric,
    minValue: minValue(1),
    maxValue: maxValue(65535)
  },
  db_name: { required },
  db_username: { required },
  db_password: {} // optional
}))

const form = ref({
  db_type: 'mysql',
  db_host: '',
  db_port: 3306,
  db_name: '',
  db_username: '',
  db_password: '',
  integration_id: integrationData.integrationId
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
    url: route('dashboard.integrations.master.db.save'),
    method: 'POST',
    data: form.value,
    onSuccess: (res) => emit('success'),
    onError: (error) => {
      if(error.response.status === 422)
        $externalResults.value = error.response.data.errors
    },
  });
}

async function testConnection () {

  v$.value.$clearExternalResults()

  // before submit check vuelidate error bag.
  if (! await v$.value.$validate()) {
    return;
  }

  testing.value = true

  callRequest({
    url: route('dashboard.integrations.test.db.connection'),
    method: 'POST',
    data: form.value,
    afterRequest: () => testing.value = false,
    onError: (error) => {
      if(error.response.status === 422)
        $externalResults.value = error.response.data.errors
    },
  });
}

watch(() => form.value.db_type, (newVal, oldVal) => {
      if (newVal === 'mysql') {
        form.value.db_port = 3306
      }

      if (newVal === 'mongodb') {
        form.value.db_port = 27017
      }
})

</script>