import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { HassidApiService } from '../hassid-api.service';

import { Subject } from 'rxjs';

@Component ({
    templateUrl: 'projet.html'
})

export class ProjetComponent implements OnInit {
    dtOptions: DataTables.Settings = {};
  // We use this trigger because fetching the list of persons can be quite long,
  // thus we ensure the data is fetched before rendering
  dtTrigger: Subject<any> = new Subject();
projects;
customers;
project_add;

  constructor (private hassidApiService: HassidApiService) {
    this.projects = [];
    this.customers = [];
    this.project_add = {};
  }
  
  
    
customerOwner: string[] = ['HASSID'];
  customerConfig: any = {
    labelField: 'company_name',
    valueField: 'id',
    searchField: ['company_name']
  };
  
  
  
  async ngOnInit() {

  
  
this.hassidApiService.getAllProjects().subscribe(projects => {
          this.projects = projects; 

          // Calling the DT trigger to manually render the table
          this.dtTrigger.next();
        });
        
        this.hassidApiService.getAllCustomers().subscribe(customers => {
          this.customers = customers; 
        });
    }
    
    
    createProject() {
        console.log(this.project_add.name);  
        const newProject = {
              id: null,
              id_client: this.customerOwner,
              name: this.project_add.name,
              comment: this.project_add.comment,
              
            };
        this.hassidApiService.createProject(newProject)
          .subscribe(response => {
          console.log(response);
          
          this.hassidApiService.getAllProjects().subscribe(projects => {
          this.projects = projects; 

         
            this.dtTrigger.next();
        });
          
        });  
    }
    
        deleteProject(id) {
            const project = {
            id_projet: id,
              
            };
        this.hassidApiService.deleteProject(project, id)
          .subscribe(response => {
          
          this.hassidApiService.getAllProjects().subscribe(projects => {
          this.projects = projects; 

         
            this.dtTrigger.next();
        });
          
           
    });
   
    }
}


