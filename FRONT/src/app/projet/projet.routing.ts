import { NgModule } from '@angular/core';
import { Routes } from '@angular/router';

//Tables Components
import { ProjetComponent } from './projet.component';
import { ProjetDetailComponent } from './projet-detail.component';


export const ProjetRoutes: Routes = [
     {
        path: '',
        component: ProjetComponent,
        data: {
           title: 'Projet'
        }
    },
        {
        path: 'detail/:id',
        component: ProjetDetailComponent,
        data: {
          title: 'Projet detail'
        }
      }
];
