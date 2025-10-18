<template>
  <!--begin::Step 3-->
  <div class="current" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
      <!--begin::Heading-->
      <div class="pb-10 pb-lg-15">
        <!--begin::Title-->
        <h2 class="fw-bolder d-flex align-items-center text-dark">Units Field Mapping
        </h2>
        <!--end::Title-->
        <!--begin::Notice-->
        <div class="text-muted fw-bold fs-6"> Map The client Field mapping for the units collection.
        </div>
        <!--end::Notice-->
      </div>
      <!--end::Heading-->
      <!--begin::Input group-->
      <div class="fv-row fv-plugins-icon-container">
        <!--begin::Row-->
        <div class="row">

          <!-- begin::Table Name -->
          <div class="mb-5 fv-row">
            <label class="required form-label">Table Name</label>
            <input type="text" class="form-control" v-model="form.name" placeholder="vehicles"/>
            <div class="invalid-feedback d-block" v-if="v$.name.$invalid && v$.name.$dirty">{{ v$.name.$errors[0].$message }}</div>
          </div>
          <!-- end::Table Name -->

          <!-- begin::Table Name -->
          <label class="required form-label">Fields</label>

          <div class="mb-5" v-for="(field, index) in form.fields">
            <div class="row">
              <div class="col-4 d-flex">
                <label class="my-auto">{{field.name}}</label>
              </div>
              <div class="col">
                <select class="form-select" v-model="field.type">
                  <option :value="null">Select Type</option>
                  <option :value="0">Direct</option>
                  <option :value="1">relation</option>
                </select>
                <div class="invalid-feedback d-block" v-if="v$.fields.$dirty && v$.fields.$each.$response.$data[index].type.$invalid">
                  {{v$.fields.$each.$response.$errors[index].type[0].$message}}
                </div>
              </div>
              <div class="col" v-if="field.type === 0">
                <input type="text" class="form-control" v-model="field.alias" placeholder="column name"/>
                <div class="invalid-feedback d-block" v-if="v$.fields.$dirty && v$.fields.$each.$response.$data[index].alias.$invalid">
                  {{ v$.fields.$each.$response.$errors[index].alias[0].$message }}
                  </div>
              </div>

            </div>
            <div class="row" v-if="field.type === 1">
              <div class="form-group">
                <label for="">relation name</label>
                <input type="text" class="form-control" v-model="field.alias" placeholder="ex. userPosts"/>
                <div class="invalid-feedback d-block" v-if="v$.fields.$dirty && v$.fields.$each.$response.$data[index].alias.$invalid">
                  {{ v$.fields.$each.$response.$errors[index].alias[0].$message }}
                </div>
              </div>
            </div>
          </div>
          <!-- end::Table Name -->

        </div>
        <!--end::Row-->
      </div>
      <!--end::Input group-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Step 3-->

  <div class="d-flex flex-stack pt-10">
    <!--  Save Form & Continue   -->
    <div class="mr-2"></div>
    <div>
      <button type="button" class="btn btn-lg btn-primary" @click="submit">Save & Continue</button>
    </div>
  </div>
</template>

<script setup>
import {ref, defineEmits, computed, inject, defineProps} from "vue";
import { useVuelidate } from '@vuelidate/core'
import { required, numeric, minValue, maxValue, helpers} from '@vuelidate/validators'
import { callRequest } from '@dashboard/axios';

const props = defineProps(['collections']);
const emit = defineEmits(['success']);

const integrationData = inject('integrationData')

const form = ref({
  name: '',
  fields: [],
  integration_id: integrationData.integrationId
});

const collection = props.collections.find(c=> c.name === 'units');
form.value.fields = collection.fields.map((f)=> ({
      id: f.id,
      name: f.name,
      type: null,
      alias: null,
}))


const rules = computed(() => ({
  name: {required},
  fields: {
    $each: helpers.forEach({
      type: {required},
      alias: {required},
    })
  }
}))

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
    url: route('dashboard.integrations.units.mapping.save'),
    method: 'POST',
    data: form.value,
    onSuccess: (res) => emit('success'),
    onError: (error) => {
      if(error.response.status === 422)
        $externalResults.value = error.response.data.errors
    },
  });
}
</script>