<template>
  <div class="w-100 dropbox" id="dropbox-file" @dragover.prevent @drop.prevent>
    <input type="file" @change="$emit('uploadFile', $event)" class="none" />
    <div @drop="$emit('dragFile', $event)" class="input-file">
      <p>{{ title }}</p>
      <div v-if="file">
        <p>{{ file[0]?.name }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DropZone",
  emits: ["uploadFile", "dragFile"],
  props: ["file", "title"],
};
</script>

<style lang="scss" scoped>
.dropbox {
  outline: 2px dashed grey;
  outline-offset: -10px;
  background: #f8f8f8;
  color: dimgray;
  padding: 10px 10px;
  min-height: 150px;
  position: relative;
  cursor: pointer;
  box-sizing: border-box;
}

.input-file {
  left: 0;
  right: 0;
  bottom: 0;
  top: 0;
  position: absolute;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.dropbox:hover {
  background: lightblue; /* when mouse over to the drop zone, change color */
}

.dropbox p {
  font-size: 1.2em;
  text-align: center;
  // padding: 50px 0;
}
</style>