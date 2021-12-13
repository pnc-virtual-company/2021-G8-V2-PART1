<template>
  <section>
    <add-search @showForm="showAddForm" @search="search"></add-search>
    <base-dialog
      v-if="dialogDisplayed"
      :title="dialogTitle"
      :mode="dialogMode"
      @close="closeDialog"
    >
      <div v-if="dialogMode !== 'delete'">
        <input
          type="text"
          id="formInput"
          placeholder="Name..."
          v-model="categoryName"
        />
        <div v-if="cateNameError" class="error">
          <p v-text="cateNameError"></p>
        </div>
      </div>

      <template #actions>
        <base-button
          @click="onConfirm"
          :class="isValidated ? 'buttonActive' : 'buttonInactive'"
          >{{ dialogButtton }}
        </base-button>
      </template>
    </base-dialog>
    <div v-if="categories.length !== 0">
      <category-card
        v-for="category of categories"
        :key="category.id"
        :category="category"
        @requestToRemove="showDeleteDialog"
        @requestToEdit="showEditForm"
        @updateCategory="updateCategory"
      ></category-card>
    </div>
    <div class="emptyCard" v-else>
      <h1 v-cloak>{{ message }}</h1>
    </div>
  </section>
</template>

<script>
import AddSearch from "../components/pages/category/AddSearch.vue";
import CategoryCard from "../components/pages/category/CategoryCard.vue";

import axios from "../axios-http.js";
export default {
  components: {
    "add-search": AddSearch,
    "category-card": CategoryCard,
  },
  data() {
    return {
      dialogMode: "create",
      dialogDisplayed: false,
      categoryName: "",
      categoryKeySearch: "",
      categoryToEdit: null,
      categories: [],
      cateNameError: "",
      message: "NO CATEGORY YET",
    };
  },
  watch: {
    categoryName: function (newValue) {
      if (newValue === "") {
        this.cateNameError = "Please enter category name";
      } else {
        this.cateNameError = "";
        for (let cate of this.categories) {
          if (
            cate.name.toLowerCase() === newValue.toLowerCase() &&
            (this.dialogMode === "create" ||
              newValue !== this.categoryToEdit.name)
          ) {
            this.cateNameError = "Category name already existed";
          }
        }
      }
    },
  },
  computed: {
    dialogTitle() {
      // return this.dialogMode === 'edit' ? 'EDIT CATEGORY' : 'CREATE CATEGORY';
      let message = "";
      if (this.dialogMode === "edit") {
        message = "EDIT CATEGORY";
      } else if (this.dialogMode === "create") {
        message = "CREATE CATEGORY";
      } else {
        message = "Are you sure you want to delete this category?";
      }
      return message;
    },
    dialogButtton() {
      // return this.dialogMode === 'edit' ? 'EDIT' : 'CREATE';
      let message = "";
      if (this.dialogMode === "edit") {
        message = "EDIT";
      } else if (this.dialogMode === "create") {
        message = "CREATE";
      } else {
        message = "DELETE";
      }
      return message;
    },
    isValidated() {
      return (
        (this.cateNameError === "" && this.categoryName !== "") ||
        this.dialogMode === "delete"
      );
    },
  },
  methods: {
    showAddForm() {
      this.dialogMode = "create";
      this.dialogDisplayed = true;
      this.cateNameError = "";
    },
    showDeleteDialog(id) {
      this.dialogMode = "delete";
      this.dialogDisplayed = true;
      this.categoryToEdit = {
        id: id,
      };
    },
    closeDialog() {
      this.dialogDisplayed = false;
      this.categoryName = "";
    },
    addNewCategory(categoryName) {
      this.dialogDisplayed = true;
      let data = {
        name: categoryName,
      };
      axios.post("api/categories", data).then((res) => {
        this.message;
        this.categories.unshift(res.data.data);
        (this.isShowAddForm = false), (this.createError = "");

        let storedCategories = JSON.parse(
          localStorage.getItem("getCategories")
        );
        storedCategories.unshift(res.data.data);
        localStorage.setItem("getCategories", JSON.stringify(storedCategories));
      });
    },
    removeCategory(id) {
      axios.delete("api/categories/" + id).then(() => {
        this.categories = this.categories.filter((cate) => cate.id !== id);

        let storedCategories = JSON.parse(
          localStorage.getItem("getCategories")
        );
        storedCategories = storedCategories.filter((cate) => cate.id !== id);
        localStorage.setItem("getCategories", JSON.stringify(storedCategories));
      });
    },
    showEditForm(id, name) {
      this.dialogMode = "edit";
      this.dialogDisplayed = true;
      this.categoryToEdit = {
        id: id,
        name: name,
      };
      this.categoryName = this.categoryToEdit.name;
      this.cateNameError = "";
    },
    updateCategory(newCateName, id) {
      let data = {
        name: newCateName,
      };
      axios.put("api/categories/" + id, data).then((res) => {
        this.categories.forEach((cate, index) => {
          if (cate.id == id) {
            this.categories.splice(index, 1, res.data.data);
          }
        });

        let storedCategories = JSON.parse(
          localStorage.getItem("getCategories")
        );
        storedCategories.forEach((cate, index) => {
          if (cate.id == id) {
            storedCategories.splice(index, 1, res.data.data);
          }
        });

        localStorage.setItem("getCategories", JSON.stringify(storedCategories));
        this.isEditing = false;
        this.editError = "";
        this.cateNameError = "";
      });
    },
    onConfirm() {
      if (this.isValidated) {
        if (this.dialogMode === "create") {
          this.addNewCategory(this.categoryName);
        } else if (this.dialogMode === "edit") {
          this.updateCategory(this.categoryName, this.categoryToEdit.id);
        } else if (this.dialogMode === "delete") {
          this.removeCategory(this.categoryToEdit.id);
        }
        this.closeDialog();
      }
    },
    search(key) {
      if (key === "") {
        this.categories = JSON.parse(localStorage.getItem("getCategories"));
      } else {
        let categoryList = JSON.parse(localStorage.getItem("getCategories"));
        this.categories = categoryList.filter((cate) =>
          cate.name.toLowerCase().includes(key.toLowerCase())
        );
      }
    },
    getCategory() {
      axios.get("api/categories").then((res) => {
        this.categories = res.data.data;
        localStorage.setItem("getCategories", JSON.stringify(this.categories));
      });
    },
  },
  mounted() {
    this.getCategory();
  },
};
</script>

<style scoped>
[v-cloak] {
  display: none;
}

.emptyCard {
  text-align: center;
  opacity: 0.2;
  margin-top: 10%;
}
input {
  padding: 15px;
}
input[type="text"] {
  padding: 10px;
  border: 0;
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid #ccc;
  outline: none;
}
input[type="text"]:focus {
  border: 2px solid var(--main-color);
}
#formInput {
  width: 350px;
}
.error {
  text-align: center;
  color: rgba(255, 0, 0, 0.575);
}
</style>
