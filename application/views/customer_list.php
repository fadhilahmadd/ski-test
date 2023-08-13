<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url('customer'); ?>">SKI CRUD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo base_url('customer'); ?>">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="customer/visualisasi">Visualisasi</a>
            </li>
            </li>
        </ul>
        </div>
    </div>
    </nav>
</head>
<body>
    <div class="container" id="customerList">
        <h1 class="mt-4">Customer List</h1>
        <button class="btn btn-primary mt-2 mb-2" data-toggle="modal" data-target="#addCustomerModal">Add Customer</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Pekerjaan</th>
                    <th>Provinsi</th>
                    <th>Kab/Kota</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo $customer['nama']; ?></td>
                        <td><?php echo $customer['jenis_kelamin']; ?></td>
                        <td><?php echo $customer['tanggal_lahir']; ?></td>
                        <td><?php echo $customer['pekerjaan']; ?></td>
                        <td><?php echo $customer['provinsi']; ?></td>
                        <td><?php echo $customer['kab_kota']; ?></td>
                        <td><?php echo $customer['kecamatan']; ?></td>
                        <td><?php echo $customer['desa']; ?></td>
                        <td>
                            <a href="<?php echo base_url('customer/edit/' . $customer['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?php echo base_url('customer/delete/' . $customer['id']); ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>        
    </div>

    <!-- Add Customer Modal -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add Customer Form -->
                    <form id="addCustomerForm">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin:</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir:</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan:</label>
                            <input type="text" class="form-control" name="pekerjaan" required>
                        </div>
                        <div class="form-group">
                            <label>Provinsi:</label>
                            <select class="form-control" id="addProvinsiSelect" name="provinsi" required>
                                <option value="">Pilih Provinsi</option>
                                <!-- Options for provinces will be dynamically added here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kabupaten / Kota:</label>
                            <select class="form-control" id="addKabKotaSelect" name="kab_kota" required>
                                <!-- Options for kabupaten/kota will be dynamically added here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan:</label>
                            <select class="form-control" id="addKecamatanSelect" name="kecamatan" required>
                                <!-- Options for kecamatan will be dynamically added here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Desa:</label>
                            <select class="form-control" id="addDesaSelect" name="desa" required>
                                <!-- Options for desa will be dynamically added here -->
                            </select>
                        </div>
                        <button id="submitAddCustomerForm" type="button" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Inside your HTML -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<script>
// Fetch province data
fetch("https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json")
    .then(response => response.json())
    .then(data => {
        const addProvinsiSelect = document.getElementById("addProvinsiSelect");
        data.forEach(province => {
            addProvinsiSelect.appendChild(new Option(province.name, province.id));
        });
    })
    .catch(error => console.error("Error fetching province data:", error));

// Event listener for province selection
addProvinsiSelect.addEventListener("change", function() {
    const selectedProvinceId = this.value;
    // Fetch kabupaten/kota data based on the selected province
    fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${selectedProvinceId}.json`)
        .then(response => response.json())
        .then(data => {
            const addKabKotaSelect = document.getElementById("addKabKotaSelect");
            addKabKotaSelect.innerHTML = "";
            data.forEach(regency => {
                addKabKotaSelect.appendChild(new Option(regency.name, regency.id));
            });
        })
        .catch(error => console.error("Error fetching kabupaten/kota data:", error));
});

// Event listener for kabupaten/kota selection
addKabKotaSelect.addEventListener("change", function() {
    const selectedRegencyId = this.value;
    // Fetch sub-district data based on the selected kabupaten/kota
    fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${selectedRegencyId}.json`)
        .then(response => response.json())
        .then(data => {
            const addKecamatanSelect = document.getElementById("addKecamatanSelect");
            addKecamatanSelect.innerHTML = "";
            data.forEach(district => {
                addKecamatanSelect.appendChild(new Option(district.name, district.id));
            });
        })
        .catch(error => console.error("Error fetching kecamatan data:", error));
});

// Event listener for kecamatan selection
addKecamatanSelect.addEventListener("change", function() {
    const selectedDistrictId = this.value;
    // Fetch sub-district data based on the selected kecamatan
    fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/subdistricts/${selectedDistrictId}.json`)
        .then(response => response.json())
        .then(data => {
            const addDesaSelect = document.getElementById("addDesaSelect");
            addDesaSelect.innerHTML = "";
            data.forEach(subdistrict => {
                addDesaSelect.appendChild(new Option(subdistrict.name, subdistrict.id));
            });
        })
        .catch(error => console.error("Error fetching desa data:", error));
});


// Event listener for sub-district selection
addKecamatanSelect.addEventListener("change", function() {
    const selectedSubDistrictId = this.value;
    // Fetch village data based on the selected sub-district
    fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${selectedSubDistrictId}.json`)
        .then(response => response.json())
        .then(data => {
            const addDesaSelect = document.getElementById("addDesaSelect");
            addDesaSelect.innerHTML = "";
            data.forEach(village => {
                addDesaSelect.appendChild(new Option(village.name, village.id));
            });
        })
        .catch(error => console.error("Error fetching village data:", error));
});

$(document).ready(function() {
    $("#submitAddCustomerForm").click(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('customer/add'); ?>",
            data: {
                nama: $("input[name='nama']").val(),
                jenis_kelamin: $("select[name='jenis_kelamin']").val(),
                tanggal_lahir: $("input[name='tanggal_lahir']").val(),
                pekerjaan: $("input[name='pekerjaan']").val(),
                provinsi: $("select[name='provinsi']").find("option:selected").text(), // Mengambil teks opsi terpilih
                kab_kota: $("select[name='kab_kota']").find("option:selected").text(),
                kecamatan: $("select[name='kecamatan']").find("option:selected").text(),
                desa: $("select[name='desa']").find("option:selected").text()
            },
            success: function(response) {
                // Close the modal using JavaScript
                $("#addCustomerModal").modal("hide");
                // Reload the page
                location.reload();
            }
        });
    });
});

</script>
</html>
