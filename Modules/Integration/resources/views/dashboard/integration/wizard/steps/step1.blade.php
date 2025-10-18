
<!--begin::Step 1-->
<div class="current" data-kt-stepper-element="content">
    <!--begin::Wrapper-->
    <div class="w-100">
        <!--begin::Heading-->
        <div class="pb-10 pb-lg-15">
            <!--begin::Title-->
            <h2 class="fw-bolder d-flex align-items-center text-dark">Choose Account Type
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Billing is issued based on your selected account type" aria-label="Billing is issued based on your selected account type"></i>
            </h2>
            <!--end::Title-->
            <!--begin::Notice-->
            <div class="text-muted fw-bold fs-6">If you need more info, please check out
                <a href="#" class="link-primary fw-bolder">Help Page</a>.
            </div>
            <!--end::Notice-->
        </div>
        <!--end::Heading-->
        <!--begin::Input group-->
        <div class="fv-row fv-plugins-icon-container">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12" v-if="currentStep === 1">
                    <div class="fv-row mb-10">
                        <label class="required form-label">Client Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter client name"/>
                        {{-- <div class="text-danger" v-if="errors.name">{{ errors.name }}</div>--}}
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