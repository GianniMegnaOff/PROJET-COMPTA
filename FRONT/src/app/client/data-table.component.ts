import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { HassidApiService } from '../hassid-api.service';

import { Subject } from 'rxjs';

@Component ({
    templateUrl: 'data-table.html'
})

export class DataTableComponent implements OnInit {
    dtOptions: DataTables.Settings = {};
  // We use this trigger because fetching the list of persons can be quite long,
  // thus we ensure the data is fetched before rendering
  dtTrigger: Subject<any> = new Subject();
  customers;
  customer_add;





  constructor (private hassidApiService: HassidApiService) {
    this.customers = [];
    this.customer_add = {};
  }
  
  
customerOwner: string[] = ['HASSID'];
  customerConfig: any = {
    labelField: 'company_name',
    valueField: 'id',
    searchField: ['company_name']
  };
  
  
  async ngOnInit() {
        this.hassidApiService.getAllCustomers().subscribe(customers => {
          this.customers = customers; 

          // Calling the DT trigger to manually render the table
          this.dtTrigger.next();
        });
    }
    
    
    createCustomer() {
        this.hassidApiService.createCustomer(this.customer_add)
          .subscribe(response => {
          console.log(response);
          this.hassidApiService.getAllCustomers().subscribe(customers => {
          this.customers = customers; 

        
            this.dtTrigger.next();
        });
        });       
    }
    
    
    createProject() {
        console.log(this.customerOwner);  
        const newProject = {
              id: null,
              id_client: this.customerOwner,
              
            };
        this.hassidApiService.createProject(newProject)
          .subscribe(response => {
          console.log(response);
          
        });  
    }
}


