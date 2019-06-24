import { Injectable } from '@angular/core';

import { HttpClientModule, HttpClient, HttpHeaders } from '@angular/common/http';

enum MethodHttp { GET, POST, PUT }

@Injectable({
  providedIn: 'root'
})
export class HassidApiService {

  // API URL
  //base = 'http://127.0.0.1:8080/';  // URL to web api -- PROD
  base = 'http://dashboard-api.gianni-megna.com/public';  // URL to web api -- DEV
  //version = '/v1';  // Version to use

  constructor(private http: HttpClient) {}

    // User
    // All    => GET /user
    // Detail => GET /user/{id}
    // Create => PUT /user/create
    // Update => PUT /user/update
    // Remove => PUT /user/remove

  getAllUsers () {
    return this.getData(MethodHttp.GET, '/user');
  }
  getUser (id) {
    return this.getData(MethodHttp.GET, '/user/' + id);
  }
  createUser (user) {
    return this.getData(MethodHttp.PUT, '/user/create', user);
  }
  updateUser (user) {
    return this.getData(MethodHttp.PUT, '/user/update', user);
  }
  removeUser (user) {
    return this.getData(MethodHttp.PUT, '/user/remove', user);
  }
 
    // Customer
    // All    => GET /customer
    // Detail => GET /customer/{id}
    // Create => PUT /customer/create
    // Update => PUT /customer/update
    // Remove => PUT /customer/remove

  getAllCustomers () {
    return this.getData(MethodHttp.GET, '/customer');
  }
  getCustomer (id) {
    return this.getData(MethodHttp.GET, '/customer/' + id);
  }
  createCustomer (customer) {
    return this.getData(MethodHttp.POST, '/customer/create', customer);
  }
  updateCustomer (customer) {
    return this.getData(MethodHttp.PUT, '/customer/update', customer);
  }
  removeCustomer (customer) {
    return this.getData(MethodHttp.PUT, '/customer/remove', customer);
  }
 
    // Produits
    // All    => GET /product
    // Detail => GET /product/{id}
    // Create => PUT /product/create
    // Update => PUT /product/update
    // Remove => PUT /product/remove

  getAllProducts () {
    return this.getData(MethodHttp.GET, '/product');
  }
  getProduct (id) {
    return this.getData(MethodHttp.GET, '/product/' + id);
  }
  createProduct (product) {
    return this.getData(MethodHttp.POST, '/product/create', product);
  }
  updateProduct (product) {
    return this.getData(MethodHttp.PUT, '/product/update', product);
  }
  removeProduct (product) {
    return this.getData(MethodHttp.PUT, '/product/remove', product);
  }
  
  
  
  updateInvoiceDeal (deal, id) {
    return this.getData(MethodHttp.PUT, '/project/' + id +'/deal/update', deal);
  }
  
  updateQuote (quote) {
    return this.getData(MethodHttp.PUT, '/quote/update', quote);
  }
  removeQuote (quote) {
    return this.getData(MethodHttp.PUT, '/quote/remove', quote);
  }
  
    // Project
    // All    => GET /project/{id_user}
    // Detail => GET /project/{id}
    // Create => PUT /project/create
    // Update => PUT /project/update
    // Remove => PUT /project/remove

  getAllProjects () {
    return this.getData(MethodHttp.GET, '/project');
  }
  getProject (id) {
    return this.getData(MethodHttp.GET, '/project/' + id);
  }
  createProject (productOwner) {
    return this.getData(MethodHttp.POST, '/project/create', productOwner);
  }

  removeProject (project) {
    return this.getData(MethodHttp.PUT, '/project/remove', project);
  }
  
  
    // Project
    // All    => GET /project/{id_user}
    // Detail => GET /project/{id}
    // Create => PUT /project/create
    // Update => PUT /project/update
    // Remove => PUT /project/remove

  getAllStatut () {
    return this.getData(MethodHttp.GET, '/statut');
  }
  
  updateStatut(statut, id) {
    return this.getData(MethodHttp.POST, '/project/statut/update/' + id, statut);
  }
  
  updateProject(project, id) {
    return this.getData(MethodHttp.POST, '/project/update/' + id, project);
  }
  
   deleteProject(project, id) {
    return this.getData(MethodHttp.POST, '/project/delete/' + id, project);
  }
  
  // Files
  // Cover App Festival  => POST /app/database/festivals/upload/cover
  // Picture App Festival => POST /app/database/festivals/upload/picture

  uploadAppDatabaseFestivalCover (cover) {
    return this.getData(MethodHttp.POST, '/app/database/festivals/upload/cover', cover);
  }
  uploadAppDatabaseFestivalPicture (picture) {
    return this.getData(MethodHttp.POST, '/app/database/festivals/upload/picture', picture);
  }


  // Le coeur de la maison
  getData(method: MethodHttp, url: string, body?: any) {
    const urlToReach = this.base + url;
    const httpOption = {
    headers: new HttpHeaders({
    'Access-Control-Allow-Origin' : '*',
    })
    
    };
    // Make request
    if (method === MethodHttp.GET) {
      return this.http.get(
        urlToReach,
        httpOption
        );

    } else if (method === MethodHttp.POST) {
      return this.http.post(
        urlToReach,
        body, 
        httpOption
      );

    } else if (method === MethodHttp.PUT) {
      return this.http.put(
        urlToReach,
        body,  
        httpOption
      );

    }

  }

}
