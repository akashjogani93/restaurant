<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" id="form1">
        <style>
        .error {
            color: red;
        }
        </style>
        <?php require_once("header.php"); 
        include("dbcon.php"); ?>
        <div class="content-wrapper">
            <section class="content">
                <div class="box box-default">
                    <div id="app">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-container">
                                    <div class="box" v-for="(box, index) in visibleBoxes" :key="index">{{ box }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="button-container">
                            <button @click="previous" :disabled="currentIndex === 0">Previous</button>
                            <button @click="next" :disabled="currentIndex >= totalBoxes - visibleBoxCount">Next</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script>
new Vue({
  el: '#app',
  data() {
    return {
      boxes: ['Menu Master', 'Table Master', 'Report Master', 'Parcel Master', 'Box 5', 'Box 6', 'Box 7', 'Box 8'], // Replace with your box data
      visibleBoxCount: 4,
      currentIndex: 0
    };
  },
  computed: {
    totalBoxes() {
      return this.boxes.length;
    },
    visibleBoxes() {
      return this.boxes.slice(this.currentIndex, this.currentIndex + this.visibleBoxCount);
    }
  },
  methods: {
    next() {
      if (this.currentIndex + this.visibleBoxCount < this.totalBoxes) 
      {
        this.currentIndex += this.visibleBoxCount;
      }
    },
    previous() {
      if (this.currentIndex > 0) {
        this.currentIndex -= this.visibleBoxCount;
      }
    }
  }
});
</script>

<style>
.box-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  margin-top: 20px;
}

.box {
  flex: 1 0 calc(25% - 10px);
  height: 150px;
  background-color: pink;
  margin: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 5px;
  font-size: 18px;
}

.button-container {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

button {
  margin: 0 5px;
}
</style>


<!--<!DOCTYPE html>
<html>
<head>
  <title>Dynamic Grid of Boxes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div id="app" class="container mt-4">
    <div class="row">
      <div class="col-md-4" v-for="box in displayedBoxes" :key="box.id">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">{{ box.title }}</h5>
            <p class="card-text">{{ box.description }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12">
        <button class="btn btn-primary mr-2" @click="previousPage" :disabled="currentPage === 1">Previous</button>
        <button class="btn btn-primary" @click="nextPage" :disabled="currentPage === totalPages">Next</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11/dist/vue.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    new Vue({
      el: '#app',
      data: {
        boxes: [], // All boxes data
        currentPage: 1, // Current page number
        pageSize: 4, // Number of boxes to display per page
      },
      computed: {
        displayedBoxes() {
          const start = (this.currentPage - 1) * this.pageSize;
          const end = start + this.pageSize;
          return this.boxes.slice(start, end);
        },
        totalPages() {
          return Math.ceil(this.boxes.length / this.pageSize);
        },
      },
      methods: {
        fetchBoxes() {
          // Fetch boxes data from PHP file
          axios.get('your_php_file.php')
            .then(response => {
              this.boxes = response.data;
            })
            .catch(error => {
              console.error(error);
            });
        },
        nextPage() {
          if (this.currentPage < this.totalPages) {
            this.currentPage++;
          }
        },
        previousPage() {
          if (this.currentPage > 1) {
            this.currentPage--;
          }
        },
      },
      mounted() {
        this.fetchBoxes();
      },
    });
  </script>
</body>
</html>-->
 