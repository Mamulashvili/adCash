<template>
  <div class="container-lg ma bg-white brd-radius box-shadow form-holder">
    <form enctype="multipart/form-data">
      <base-input
        additionalClassWrapper="mb-3"
        additionalClassInput="w-100"
        v-model.trim="username"
        label="Username"
        rules="required"
        id="username"
        type="text"
      />
      <base-input
        additionalClassWrapper="mb-3"
        additionalClassInput="w-100"
        v-model.trim="fname"
        label="Firstname"
        rules="required"
        type="text"
        id="fname"
      />
      <base-input
        additionalClassWrapper="mb-3"
        additionalClassInput="w-100"
        v-model.trim="lname"
        label="Lastname"
        rules="required"
        type="text"
        id="lname"
      />
      <drop-zone
        :file="file"
        @dragFile="dragFile"
        @uploadFile="uploadFile"
        title="Drag and drop user avatar here"
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
        Register user
      </base-button>
    </form>
    <success-modal
      v-if="responseSuccess"
      title="Congrats!"
      :content="`New user (@${username}) added successfully!`"
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
    SuccessModal: FormAddSuccessModal,
    BaseButton,
    BaseInput,
    DropZone,
  },
  data() {
    return {
      username: "",
      fname: "",
      lname: "",
      file: null,

      responseSuccess: false,
      showMandatoryFieldsError: false,
      responseErrors: null,
    };
  },

  methods: {
    submitForm(e) {
      e.preventDefault();
      // Usually, i'm using vuelidate library for form handling
      if (
        this.username.length <= 0 ||
        this.fname.length <= 0 ||
        this.lname.length <= 0
      )
        return (this.showMandatoryFieldsError = true);
      else this.showMandatoryFieldsError = false;

      let formData = new FormData();
      formData.append("username", this.username);
      formData.append("fname", this.fname);
      formData.append("lname", this.lname);
      this.file && formData.append("file", this.file?.[0]);

      HTTP.post(`/users`, formData)
        .then((response) => {
          console.log(response.status === 200);
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