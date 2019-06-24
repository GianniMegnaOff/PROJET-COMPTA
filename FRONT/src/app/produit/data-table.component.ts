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
 products;
 product_add;

  constructor (private hassidApiService: HassidApiService) {
    this.products = [];
    this.product_add = {};
  }
  async ngOnInit() {
this.hassidApiService.getAllProducts().subscribe(products => {
          this.products = products; 

          // Calling the DT trigger to manually render the table
          this.dtTrigger.next();
        });
    }
    
    
    createProduct() {
    console.log(this.product_add);
        this.hassidApiService.createProduct(this.product_add)
          .subscribe(response => {
          console.log(response);
          this.hassidApiService.getAllProducts().subscribe(products => {
          this.products = products; 

          // Calling the DT trigger to manually render the table
           
            this.dtTrigger.next();
        });
        });

        
    }
}


