<template>
    <div class="container">
        <h1>Items Management Page</h1>
        <div class="row justify-content-center items-management">

            <div class="input-group col-md-5">
                <input type="text" class="form-control" v-model="item" placeholder="Enter Item Name and Click Add" aria-label="Enter Item Name and Click Add" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" @click="addItem()" type="button">Add</button>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5"><h3>Selected Items:</h3></div>

            <div class="col-md-5">
                <ul class="list-group">
                    <li v-for="(item, index) in itemsLeft" class="list-group-item" @click="selectedLeft(index)"
                        :class="{ 'active': activeIndexL === index}">
                        {{ item.name }}
                    </li>
                </ul>
            </div>
            <div class="col-md-2 text-center">
                <div class="col-md-12" @click="moveRight()"> <button> > </button> </div>
                <div class="col-md-12" @click="moveLeft()"> <button> < </button> </div>
            </div>
            <div class="col-md-5">
                <ul class="list-group">
                    <li v-for="(item, index) in itemsRight" class="list-group-item" @click="selectedRight(index)"
                        :class="{ 'active': activeIndexR === index}">
                        {{ item.name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                item: '',
                itemsLeft: [],
                selectedL: '',
                selectedR: '',
                itemsRight: [],
                activeIndexL: undefined,
                activeIndexR: undefined
            }
        },
        mounted() {
            this.getItems();
        },
        methods: {
            selectedLeft(item) {
                this.activeIndexL = item;
                this.selectedL = item;
                this.activeIndexR = undefined;
            },
            selectedRight(item) {
                this.activeIndexR = item;
                this.selectedR = item;
                this.activeIndexL = undefined;
            },
            moveLeft() {
                this.updateItem(this.itemsRight[this.selectedR].id, false);
                this.itemsLeft.push(this.itemsRight[this.selectedR]);
                this.itemsRight.splice(this.selectedR, 1);
                this.activeIndexR = this.activeIndexL = undefined;
            },
            moveRight() {
                this.updateItem(this.itemsLeft[this.selectedL].id, true);
                this.itemsRight.push(this.itemsLeft[this.selectedL]);
                this.itemsLeft.splice(this.selectedL, 1);
                this.activeIndexR = this.activeIndexL = undefined;
            },
            getItems() {
                axios.get(`/api/item`).then(response => {
                    this.itemsLeft = response.data.data.left;
                    this.itemsRight = response.data.data.right;
                })
            },
            addItem() {
                axios.post(`/api/item`, {
                    item: this.item
                }).then(response => {
                    this.item = '';
                    this.getItems();
                })
            },
            updateItem(id, selected) {
                axios.post(`/api/item/`+id, {
                    selected: selected
                }).then(response => {
                    this.getItems();
                })
            }
        }
    }
</script>
