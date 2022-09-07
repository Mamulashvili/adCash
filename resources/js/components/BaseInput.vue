<template>
  <div :class="[additionalClassWrapper]">
    <label v-if="label" :for="id" class="form-control-label">
      <span>{{ label }} </span>
      <span v-if="this.rules">*</span>
    </label>
    <input
      :id="id"
      :type="type"
      :value="modelValue"
      :disabled="disabled"
      :style="additionalStyle"
      :placeholder="placeholder"
      @blur="validate($event.target.value)"
      :class="['form-control', additionalClassInput]"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <small v-if="showErrorMessage" class="txt-danger fs-s mt-1">
      {{ validateErrorMessage }}
    </small>
  </div>
</template>

<script>
export default {
  name: "BaseInput",
  emits: ["update:modelValue"],
  data() {
    return {
      showErrorMessage: false,
    };
  },
  props: {
    id: {
      type: String,
      required: true,
    },
    type: {
      type: String,
      required: true,
      default: "text",
    },
    label: {
      type: String,
      required: false,
      default: "",
    },
    modelValue: {
      type: [String, Number],
      required: true,
    },
    placeholder: {
      type: String,
      required: false,
      default: "",
    },
    additionalClassInput: {
      type: String,
      required: false,
    },
    additionalClassWrapper: {
      type: String,
      required: false,
    },
    additionalStyle: {
      type: String,
      required: false,
    },
    rules: {
      type: String,
      required: false,
    },
    disabled: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  methods: {
    validate(val) {
      // Handle 'required' property only for example app
      // Laravel-like validation can be implemented
      if (!this.rules) return;
      if (this.rules === "required" && val.length === 0)
        this.showErrorMessage = true;
      else this.showErrorMessage = false;
    },
  },
  computed: {
    validateErrorMessage: function () {
      return `${this.label} is required`;
    },
  },
};
</script>

<style lang="scss" scoped>
input:disabled {
  background-color: #8b8b8b52;
  cursor: not-allowed;
}
</style>