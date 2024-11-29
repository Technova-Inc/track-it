<!-- Main content area -->
<div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="container">
        <h1 class="mb-3 text-center"><?php echo $pc[0]['NAME']?></h1>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Informations système</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th scope="row">OS :</th>
                                        <td class="text-start"><?php echo $pc[0]['OSNAME']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">OS Version :</th>
                                        <td class="text-start"><?php echo $pc[0]['OSVERSION']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Architecture :</th>
                                        <td class="text-start"><?php echo $pc[0]['ARCH']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Utilisateur windows :</th>
                                        <td class="text-start"><?php echo $pc[0]['WINOWNER']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Licence windows :</th>
                                        <td class="text-start"><?php echo $pc[0]['WINPRODID']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Clé windows :</th>
                                        <td class="text-start"><?php echo $pc[0]['WINPRODKEY']?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0">Hardware</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">Swap :</th>
                                    <td class="text-start"><?php echo $pc[0]['SWAP']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">RAM :</th>
                                    <td class="text-start"><?php echo $pc[0]['MEMORY']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Uuid :</th>
                                    <td class="text-start"><?php echo $pc[0]['UUID']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Réseau</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th scope="row">Domaine :</th>
                                        <td class="text-start"><?php echo $pc[0]['WORKGROUP']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Adresse IP :</th>
                                        <td class="text-start"><?php echo $pc[0]['IPADDR']?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0">Agent</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">User agent :</th>
                                    <td class="text-start"><?php echo $pc[0]['USERAGENT']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernier inventaire :</th>
                                    <td class="text-start"><?php echo $pc[0]['LASTDATE']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Dernier contact :</th>
                                    <td class="text-start"><?php echo $pc[0]['LASTCOME']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0">Note</h5>
                    </div>
                    <div class="card-body">
                        <textarea
                            value="<?php echo $pc[0]['DESCRIPTION']?>"
                            class="form-control"
                            rows="5"
                            placeholder="Insérer une note pour <?php echo $pc[0]['NAME']?>"
                        ></textarea>
                        <button class="btnv btn btn-primary mt-3 w-100">Sauvegarder</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-auto mb-4">
                <div class="card shadow-lg percentage-card">
                    <div
                        class="card-body text-center d-flex flex-column justify-content-center align-items-center"
                    >
                        <h5 class="card-title">ID Disque 1</h5>
                        <div class="arc-container">
                            <svg width="200" height="100" viewBox="0 0 200 100">
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="80"
                                    fill="none"
                                    stroke="#4caf50"
                                    stroke-width="20"
                                />
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="80"
                                    fill="none"
                                    stroke="#ddd"
                                    stroke-width="20"
                                    stroke-dasharray="251"
                                    stroke-dashoffset="0"
                                    id="storage-arc1"
                                />
                            </svg>
                            <div class="percentage" id="percentage-text1">100%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto mb-4">
                <div class="card shadow-lg percentage-card">
                    <div
                        class="card-body text-center d-flex flex-column justify-content-center align-items-center"
                    >
                        <h5 class="card-title">ID Disque 2</h5>
                        <div class="arc-container">
                            <svg width="200" height="100" viewBox="0 0 200 100">
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="80"
                                    fill="none"
                                    stroke="#4caf50"
                                    stroke-width="20"
                                />
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="80"
                                    fill="none"
                                    stroke="#ddd"
                                    stroke-width="20"
                                    stroke-dasharray="251"
                                    stroke-dashoffset="0"
                                    id="storage-arc2"
                                />
                            </svg>
                            <div class="percentage" id="percentage-text2">100%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto mb-4">
                <div class="card shadow-lg percentage-card">
                    <div
                        class="card-body text-center d-flex flex-column justify-content-center align-items-center"
                    >
                        <h5 class="card-title">ID Disque 3</h5>
                        <div class="arc-container">
                            <svg width="200" height="100" viewBox="0 0 200 100">
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="80"
                                    fill="none"
                                    stroke="#4caf50"
                                    stroke-width="20"
                                />
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="80"
                                    fill="none"
                                    stroke="#ddd"
                                    stroke-width="20"
                                    stroke-dasharray="251"
                                    stroke-dashoffset="0"
                                    id="storage-arc3"
                                />
                            </svg>
                            <div class="percentage" id="percentage-text3">100%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto mb-4">
                <div class="card shadow-lg percentage-card">
                    <div
                        class="card-body text-center d-flex flex-column justify-content-center align-items-center"
                    >
                        <h5 class="card-title">ID Disque 4</h5>
                        <div class="arc-container">
                            <svg width="200" height="100" viewBox="0 0 200 100">
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="80"
                                    fill="none"
                                    stroke="#4caf50"
                                    stroke-width="20"
                                />
                                <circle
                                    cx="100"
                                    cy="100"
                                    r="80"
                                    fill="none"
                                    stroke="#ddd"
                                    stroke-width="20"
                                    stroke-dasharray="251"
                                    stroke-dashoffset="0"
                                    id="storage-arc4"
                                />
                            </svg>
                            <div class="percentage" id="percentage-text4">100%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>