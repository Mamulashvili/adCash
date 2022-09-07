<template>
  <div class="container-lg ma bg-white brd-radius box-shadow form-holder">
    <form enctype="multipart/form-data">
      <base-input
        additionalClassWrapper="mb-3"
        additionalClassInput="w-100"
        v-model.trim="stockName"
        label="Stock name"
        rules="required"
        id="st_name"
        type="text"
      />
      <base-input
        additionalClassWrapper="mb-3"
        additionalClassInput="w-100"
        v-model.trim="price"
        label="Stock price"
        rules="required"
        type="number"
        id="st_price"
      />
      <base-input
        additionalClassInput="w-100 p-0"
        additionalClassWrapper="mb-3"
        v-model.trim="accentColor"
        label="Accent color"
        id="st_accent_c"
        type="color"
      />
      <base-input
        additionalClassInput="w-100 p-0"
        additionalClassWrapper="mb-3"
        label="Background color"
        v-model.trim="bgColor"
        id="st_bg_c"
        type="color"
      />

      <drop-zone
        :file="file"
        @dragFile="dragFile"
        @uploadFile="uploadFile"
        title="Drag and drop stock icon here"
      />

      <small
        v-if="showMandatoryFieldsError || responseErrors"
        class="txt-danger fs-s mt-2 mb-2 block"
      >
        <span class="block">
          {{
            showMandatoryFieldsError
              ? "Please fill required fields. (Marked with * symbol)"
              : null
          }}
          <p
            v-for="(error, index) in responseErrors"
            :key="index"
            class="block mt-1"
          >
            {{ error?.[0] }}
          </p>
        </span>
      </small>

      <base-button @handleClick="submitForm" additionalClass="mt-2">
        Add new stock
      </base-button>
    </form>
    <success-modal
      v-if="responseSuccess"
      title="Great!"
      content="New stock created successfully!"
    />
  </div>
</template>

<script>
import FormAddSuccessModal from "@components/FormAddSuccessModal";
import BaseButton from "@components/BaseButton.vue";
import BaseInput from "@components/BaseInput.vue";
import DropZone from "@components/DropZone";
import { HTTP } from "@utils/HTTP";

export default {
  name: "FormUserAdd",
  components: {
    BaseInput,
    BaseButton,
    SuccessModal: FormAddSuccessModal,
    DropZone,
  },
  data() {
    return {
      stockName: "",
      price: "",
      accentColor: "",
      bgColor: "",
      file: null,
      showMandatoryFieldsError: false,
      responseErrors: null,
      responseSuccess: false,
    };
  },

  methods: {
    submitForm(e) {
      e.preventDefault();
      // Usually, i'm using vuelidate library for form handling

      if (this.stockName.length <= 0 || this.price.length <= 0)
        return (this.showMandatoryFieldsError = true);
      else this.showMandatoryFieldsError = false;

      let formData = new FormData();
      this.file && formData.append("file", this.file?.[0]);
      formData.append("name", this.stockName);
      formData.append("price", this.price);
      formData.append("accentColor", this.accentColor || "#000");
      formData.append("bgColor", this.bgColor || "#000");

      HTTP.post(`/stock`, formData)
        .then((response) => {
          if (response.status === 200) this.responseSuccess = true;
        })
        .catch((err) => {
          const { response } = err;
          this.responseSuccess = false;
          if (response?.status === 422)
            this.responseErrors = Object.values(response?.data?.errors);
          else alert("Something went wrong 😔");
        });
    },

    // FILE dropzone methods
    uploadFile(e) {
      this.file = e.target.files;
    },
    dragFile(e) {
      this.file = e.dataTransfer.files;
    },
  },
};
</script>
