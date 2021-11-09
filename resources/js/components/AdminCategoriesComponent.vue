<template>
    <div>
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white pull-left">Categories</h4> 
            </div>
            <div class="card-body">
                <div action="#" v-if="mode == 'create'">
                 <div class="form-body">
                        <!-- <h3 class="card-title">Person Info</h3>
                            <hr>-->
                            <div class="row p-t-10">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Category Name</label>
                                        <input type="text" id="category-name" class="form-control" placeholder="Category Name"
                                        v-model="record.name">
                                        <small class="small text-danger" v-if="errors.name">
                                            {{errors.name[0]}}
                                        </small>
                                        <!-- <small class="form-control-feedback"> This is inline help </small> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Category Slug</label>
                                        <input type="text" id="category-slug" class="form-control" placeholder="Category Slug"
                                        v-model="record.slug">
                                        <small class="small text-danger" v-if="errors.slug">
                                            {{errors.slug[0]}}
                                        </small>
                                        <!-- <small class="form-control-feedback"> This is inline help </small> -->
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Category Slug</label>
                                        <v-select class="vue-select3" name="select3"
                                        :options="allcategories" v-model="record.category_id"
                                        :searchable="true">
                                    </v-select>

                                    <!-- <small class="form-control-feedback"> This is inline help </small> -->
                                </div>
                            </div>

                        </div>
                        <!--/row-->
                    </div>
                    <div class="form-actions">
                        <button v-if="record.id == 0" class="btn btn-success" @click="update()"> <i
                            class="fa fa-check"></i> Save</button>
                            <button v-if="record.id != 0" class="btn btn-primary" @click="update()"> <i class="fa fa-check"></i>
                            Update</button>
                            <button type="button" class="btn btn-inverse" @click="cancel()">Cancel</button>
                        </div>
                    </div>

                    <div action="#" v-if="mode == 'view'">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <input @keyup="get()" v-model="searchParam" type="text" class="form-control col-md-6 " placeholder="Search...">
                                            <div class="col-md-6">
                                                <button type="button" class="btn waves-effect waves-light btn-success" @click="mode='create'">Add Category</button>
                                            </div>
                                        </div>
                                        <div class="white-box">
                                            <h3 clas="box-title">Categories</h3>

                                            <div class="table-responsive">
                                                <table class="table text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-top-0">#</th>
                                                            <th class="border-top-0">Name</th>
                                                            <th class="border-top-0">Slug</th>
                                                            <th class="border-top-0"></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <tr v-for="(item, index) in categories.data" :key="index">
                                                        <td>{{item.name}}</td>
                                                        <td>{{item.slug}}</td>
                                                        <td style="width:100px;"><button class="btn btn-primary" @click="record=item;mode='create'">Edit</button></td>
                                                        <td style="width:100px;">
                                                            <button type="button" class="btn waves-effect waves-light btn-danger"  v-on:click.prevent="cat_delete(item.id )">Delete</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <pagination :data="categories" @pagination-change-page="get"></pagination>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--/row-->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        </template>

        <script>
        export default {
            props: ['categoriesdata', 'allcategories'],
            data() {
                return {
                    record: {
                        id: 0,
                        name: '',
                        category_id: '',
                        slug:''
                    },
                    searchParam: '',
                    categories: this.allcategories,
                    mode: 'view',
                    errors: {}
                }
            },
            methods: {
                get(page = 1){
                    axios.post("category/action/get/all?page=" + page, {
                        searchParam: this.searchParam
                    })
                    .then((res) => {
                        this.categories = res.data
                    })
                    .catch((err)=>{

                    })
                },
                update() {
                    axios.post("save-category", this.record)
                    .then((res) => {
                        this.$swal('Success', 'Category updated successfully')
                        this.errors = []
                        this.get(1);
                        this.cancel();
                    })
                    .catch((err)=>{
                        this.errors = err.response.data.validation
                    })
                },
                cancel(){
                    this.mode = 'view'
                    this.record = {
                        id: 0,
                        name: '',
                        category_id: '',
                        slug:''
                    }
                    this.errors = {}
                    this.get()
                },
                cat_delete(id){
                 axios.post("category/action/delete/"+id, this.record)
                 .then((res) => {
                    this.$swal('Success', 'Category deleted successfully')
                    this.errors = []
                    this.get(1);
                })
                 .catch((err)=>{
                    this.errors = err.response.data.validation
                })
             }
         },
         created(){


            console.log(this.allcategories);
         }
     }

     </script>
