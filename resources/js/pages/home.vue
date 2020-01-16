<template>
  <div>
    <h2>Manage Subscibers</h2>
    <hr/>
    <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Name <b> Email </b>
        <span class="badge badge-default badge-pill">Action</span>
      </li>
      <li v-for="sub in subscribers" class="list-group-item d-flex justify-content-between align-items-center">
        {{ sub.name }} <b>{{ sub.email }}</b>
        <span class="badge badge-primary badge-pill" @click="editModal(sub, $event)">Edit</span>
      </li>
    </ul>

    <br/>
    <div>
      <button type="button" class="btn btn-dark" @click="createSubModal">Create Subscriber</button>
    </div>

    <!-- Edit Sub Modal -->
    <modal name="edit-sub" adaptive height="auto"  style="scroll: auto">
      <form style="padding: 25px;">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="email">
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" placeholder="Name" v-model="name">
        </div>

        <select name="state" class="custom-select custom-select-md mb-3" v-model="state">
          <option value="active">Active</option>
          <option value="unsubscribed">Unsubscribed</option>
          <option value="junk">Junk</option>
          <option value="bounced">Bounced</option>
          <option value="unconfirmed">Unconfirmed</option>
        </select>

        <button type="submit" class="btn btn-primary" @click="updateSub">Update</button>
        <button type="submit" class="btn btn-danger" @click="deleteSub">Delete</button>

        <hr />
        <div style="padding: 15px">
          <h4>Add Fields</h4>
          <form>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Enter field title" v-model="title">
            </div>
            <div class="form-group">
              <label for="type">Type (string, number, boolean, date)</label>
              <input type="text" name="type" class="form-control" placeholder="Enter field type" v-model="type">
            </div>
            <button type="submit" class="btn btn-primary" @click="addField">Add</button>
          </form>
        </div>

        <hr />
        <div style="padding: 15px;">
          <h4>Manage Fields</h4>
          <hr/>
          <ul class="list-group" style="height: 220px; overflow: auto">
            <li v-for="field in selectedSubFields" class="list-group-item d-flex justify-content-between align-items-center">
              <p>Title: </p> <inline-text-editor :value="field.title" @blur="onBlur" @close="onClose" @change="onChange('title', $event)" @open="onOpen" @update="onUpdate(field, 'title')"/>
              <p>Type:</p> <inline-text-editor :value="field.type" @blur="onBlur" @close="onClose" @change="onChange('type', $event)" @open="onOpen" @update="onUpdate(field, 'type')" />
            </li>
          </ul>
        </div>
      </form>
    </modal>

    <!-- Create Sub Modal -->
    <modal name="create-sub" adaptive height="auto">
      <form style="padding: 25px;">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="email">
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" placeholder="Name" v-model="name">
        </div>

        <select name="state" class="custom-select custom-select-md mb-3" v-model="state">
          <option value="active">Active</option>
          <option value="unsubscribed">Unsubscribed</option>
          <option value="junk">Junk</option>
          <option value="bounced">Bounced</option>
          <option value="unconfirmed">Unconfirmed</option>
        </select>

        <button type="submit" class="btn btn-primary" @click="createSub">Create</button>
      </form>
    </modal>

  </div>
</template>

<script>
import axios from 'axios';
import VueInlineTextEditor from 'vue-inline-text-editor';

export default {
  middleware: 'auth',
  components: {
      'inline-text-editor': VueInlineTextEditor
  },
  metaInfo () {
    return { title: this.$t('home') }
  },

  created() {
    this.getAllSubs();
  },

  data() {
    return {
      subscribers: [],
      selectedSub: {},
      state: '',
      name: '',
      email: '',
      selectedSubFields: [],
      title: '',
      type: '',
    }
  },

  methods: {
    editModal(sub, event) {
      this.$modal.show('edit-sub');
      this.selectedSub = sub;
      this.state = sub.state;
      this.email = sub.email;
      this.name = sub.name;
      this.setSubFields(sub);
      // set sub;
    },
    createSubModal() {
      this.state = '';
      this.email = '';
      this.name = '';
      this.$modal.show('create-sub');
      // set sub;
    },
    updateSub(event) {
      event.preventDefault();
      var editedSub = {
        email: this.email,
        state: this.state,
        name: this.name,
      }
      axios.put(`/api/subscribers/${this.selectedSub.id}`, editedSub)
      .then((result) => {
        //this.subscribers = result.data.subscribers;
        this.$modal.hide('edit-sub');
        this.getAllSubs();
      })
      .catch((error) => {
        alert(JSON.stringify(error.response.data,null,'\t'));

      })
    },
    createSub(event) {
      event.preventDefault();
      var sub = {
        email: this.email,
        state: this.state,
        name: this.name,
      }
      axios.post(`/api/subscribers/`, sub)
      .then((result) => {
        //this.subscribers = result.data.subscribers;
        this.$modal.hide('create-sub');
        this.getAllSubs();
      })
      .catch((error) => {
        alert(JSON.stringify(error.response.data,null,'\t'));
      })
    },
    deleteSub(event) {
      event.preventDefault();
      axios.delete(`/api/subscribers/${this.selectedSub.id}`)
      .then((result) => {
        //this.subscribers = result.data.subscribers;
        this.$modal.hide('edit-sub');
        this.getAllSubs();
      })
      .catch((error) => {
        alert(JSON.stringify(error.response.data,null,'\t'));

      })
    },
    getAllSubs() {
      axios.get('/api/subscribers')
      .then((result) => {
        this.subscribers = result.data.subscribers
      })
      .catch((error) => {
        alert(JSON.stringify(error.response.data,null,'\t'));
      })
    },
    setSubFields(sub) {
      axios.get(`/api/subscribers/${sub.id}/fields/`)
      .then((result) => {
        console.log(result);
        this.selectedSubFields = result.data.fields
      })
      .catch((error) => {
        alert(JSON.stringify(error.response.data,null,'\t'));
      })
    },
    addField() {
      event.preventDefault();
      var field = {
        title: this.title,
        type: this.type,
        subscriber_id: this.selectedSub.id
      }
      axios.post(`/api/fields/`, field)
      .then((result) => {
        this.title = '';
        this.type = '';
        this.setSubFields(this.selectedSub);
      })
      .catch((error) => {
        alert(JSON.stringify(error.response.data,null,'\t'));

      })
    },
    onBlur: function() {
        console.log('text blur:');
    },
    onClose: function() {
        console.log('text close:');
    },
    onChange: function (name, e) {
        this[name] = e.target.value;
    },
    onOpen: function () {
        console.log('text open:');
    },
    onUpdate: function(field, toUpdate) {
        console.log('text update:', field, toUpdate, this[toUpdate]);
        field[toUpdate] = this[toUpdate];
        axios.put(`/api/fields/${field.id}`, field)
        .then((result) => {
          //this.subscribers = result.data.subscribers;
          console.log("result", result.data)
        })
        .catch((error) => {
          alert(JSON.stringify(error.response.data,null,'\t'));

        })
    }
  }
}
</script>
