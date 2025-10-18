<template>
  <div class="d-flex justify-content-center bg-body rounded justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-400px me-9">
    <div class="px-6 px-lg-10 px-xxl-15 py-20">
      <div class="stepper-nav">
        <div v-for="(step, index) in steps" class="stepper-item" :class="{
          'current': currentStep === step.id,
          'completed': currentStep > step.id
        }">
          <div class="stepper-line w-40px" v-if="index < steps.length - 1"></div>
          <div class="stepper-icon w-40px h-40px">
            <i class="stepper-check fas fa-check"></i>
            <span class="stepper-number">{{ index + 1 }}</span>
          </div>
          <div class="stepper-label">
            <h3 class="stepper-title">{{ step.title }}</h3>
            <div class="stepper-desc fw-bold">{{ step.desc }}</div>
          </div>
        </div>
        <div class="stepper-item d-none"></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {defineProps} from 'vue';
const props = defineProps(['steps', 'currentStep']);
</script>