import { Component, OnInit } from '@angular/core';
import { HassidApiService } from '../hassid-api.service';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { switchMap, map } from 'rxjs/operators';
import { Subject, Observable, Subscription } from 'rxjs';
import {NgbDateAdapter, NgbDateStruct, NgbDateNativeAdapter} from '@ng-bootstrap/ng-bootstrap';
import { ToastyService, ToastyConfig, ToastOptions, ToastData } from 'ng2-toasty';
import { NotificationCommunicationService } from './../ui-elements/notification/notification.services';


@Component ({
    templateUrl: 'projet-detail.html'
})

export class ProjetDetailComponent implements OnInit {

  idgood;
  projet;
  statuts;
  totalToootal;
constructor (private hassidApiService: HassidApiService, private route: ActivatedRoute, private toastyService: ToastyService,
    private toastCommunicationService: NotificationCommunicationService) {
 this.projet = [];
}

  
  async ngOnInit() {
        this.idgood = this.route.snapshot.paramMap.get('id');
        
        this.hassidApiService.getProject(this.idgood).subscribe(projet => {
         this.projet = projet; 
          this.calculTotaux();
        });
        
        this.hassidApiService.getAllStatut().subscribe(statuts => {
         this.statuts = statuts; 
          
        });
        
        console.log(this.statuts);
  }
  
  
  
  statutConfig: any = {
    labelField: 'nom',
    valueField: 'id',
    searchField: ['nom']
  };
  
   updateStatut() {
   const statut = {
            id_projet: this.projet.id,
              id_statut: this.projet.statut.id,
              
            };
        this.hassidApiService.updateStatut(statut, this.projet.id)
          .subscribe(response => {
         this.toastyNotifSuccess('Les infos sont à jour.');
          
        });  
    }
    
       updateProject() {
   const project = {
            id_projet: this.projet.id,
            name: this.projet.name,
            comment: this.projet.comment
              
            };
        this.hassidApiService.updateProject(project, this.projet.id)
          .subscribe(response => {
          this.toastyNotifSuccess('Les infos sont à jour.');
          
        });  
    }
    
     deleteProject() {
   const project = {
            id_projet: this.projet.id,
              
            };
        this.hassidApiService.deleteProject(project, this.projet.id)
          .subscribe(response => {
          
          
          this.toastyNotifSuccess('DELLLLL');
           
    });
   
    }
    
        calculTotaux()
{
     this.totalToootal = this.projet.deal.reduce(function(prev, cur) {
          return prev + (cur.quantity *(cur.price * ( 1+(cur.tva /100))))
      }, 0);
}

toastyNotifSuccess(text: string) {
    const toastOptions: ToastOptions = {
      title: 'Super !',
      msg: text,
      showClose: true,
      timeout: 5000,
      theme: 'default',
    };
    this.toastyService.success(toastOptions);
  }
}


