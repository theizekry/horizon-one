<template>
  <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_create_account_stepper" data-kt-stepper="true">
    <Aside :steps="steps" :current-step="currentStepId"/>
    <!--begin::Content-->
    <div class="d-flex flex-row-fluid flex-center bg-body rounded">
      <div class="py-20 w-100 w-xl-700px px-9 fv-plugins-bootstrap5 fv-plugins-framework">
        <component :is="currentStep.component" :collections="collections" @success="successCallback"></component>
      </div>
    </div>
    <!--end::Content-->
  </div>
</template>

<script setup>
import Aside from "./Aside.vue";
import {ref, computed, provide, defineProps} from "vue";
import General from "./Steps/General.vue";
import MasterDatabase from "./Steps/MasterDatabase.vue";
import UnitsMapping from "./Steps/UnitsMapping.vue";

const currentStepId = ref(1);
const integrationData = ref({})
provide('integrationData', integrationData.value)

const props = defineProps(['collections']);

const steps = [
  {id: 1, title: 'General Information', desc: 'Basic Information about the client', component: General},
  {id: 2, title: 'Master Database', desc: 'Master Database Configuration', component: MasterDatabase},
  {id: 3, title: 'Units Field Mapping', desc: 'Map units keys', component: UnitsMapping},
  {id: 4, title: 'Users Field Mapping', desc: 'Map users keys'},
  // {id: 2, title: 'OAuth Scopes', desc: 'What APIs the client can use', component: Oauth},
  // {id: 3, title: 'Database Config', desc: 'DB connection and credentials'},
  // {id: 4, title: 'Field Mapping', desc: 'Map standard fields'},
  // {id: 5, title: 'Completed', desc: 'Review and activate'}
];

const currentStep = computed(() => steps.find((step) => step.id === currentStepId.value));

function successCallback(payload) {
  if(payload !== undefined){
    Object.keys(payload).forEach((key)=> integrationData.value[key] = payload[key]);
  }
  // integrationId.value = payload.integrationId

  // const currentStepIndex = steps.findIndex((s) => s.id === currentStepId.value);
  // if (currentStepIndex > -1 && steps.length >= currentStepIndex + 1)
  //   currentStepId.value = steps[currentStepIndex + 1].id;

  const currentStepIndex = steps.findIndex(s => s.id === currentStepId.value);

  const nextStep = steps[currentStepIndex + 1];
  if (nextStep) {
    // Go next
    currentStepId.value = nextStep.id;
  } else {
    alert("Good job, well done!")
  }
}

</script>