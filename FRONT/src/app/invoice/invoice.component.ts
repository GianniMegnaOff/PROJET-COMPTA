
import { Component,OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormControl, FormArray, NgForm } from '@angular/forms'

import { HassidApiService } from '../hassid-api.service';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { switchMap, map } from 'rxjs/operators';
import { Subject, Observable, Subscription } from 'rxjs';
import {NgbDateAdapter, NgbDateStruct, NgbDateNativeAdapter} from '@ng-bootstrap/ng-bootstrap';
import * as jspdf from 'jspdf';  
import html2canvas from 'html2canvas';  
@Component({
   templateUrl: 'invoice.html'
})

export class InvoiceComponent implements OnInit{

  idgood;

  projet;
  products;
    totalToootal;
  constructor(private fb: FormBuilder,private hassidApiService: HassidApiService, private route: ActivatedRoute) {
 this.projet = [];
      this.totalToootal = 0;
    
  }

productSelected: string[] = ['HASSID'];
  productConfig: any = {
    labelField: 'name',
    valueField: 'id',
    searchField: ['name']
  };
  
  
  async ngOnInit()  {
       
        this.idgood = this.route.snapshot.paramMap.get('id_projet');
        console.log(this.idgood);
        
        
        this.hassidApiService.getProject(this.idgood).subscribe(projet => {
          this.projet = projet; 
            console.log(this.projet);
          this.calculTotaux() 
        });
        
         this.hassidApiService.getAllProducts().subscribe(products => {
          this.products = products; 

          // Calling the DT trigger to manually render the table

        });
      
      
  }

  onAddRow() {
    this.projet.deal.push({
        id: null,
        id_product: 0,
        id_project: this.projet.id,
        price: 0,
        quantity: 0,
        tva: 0
    });
    console.log(this.projet.deal);
  }

  onRemoveRow(rowIndex:number){
    this.projet.deal.splice(rowIndex);
  }

    calculTotaux()
{
     this.totalToootal = this.projet.deal.reduce(function(prev, cur) {
          return prev + (cur.quantity *(cur.price * ( 1+(cur.tva /100))))
      }, 0);
    
    this.hassidApiService.updateInvoiceDeal(this.projet.deal, this.projet.id).subscribe(deal => {
        this.projet.deal = deal;
    });  
    
}

   public captureScreen()  
  {  
    var data = document.getElementById('contentToConvert');  
    html2canvas(data).then(canvas => {  
      // Few necessary setting options  
      var imgWidth = 208;   
      var pageHeight = 295;    
      var imgHeight = canvas.height * imgWidth / canvas.width;  
      var heightLeft = imgHeight;  
  
      const contentDataURL = canvas.toDataURL('image/png')  
      let pdf = new jspdf('p', 'mm', 'a4'); // A4 size page of PDF  
      var position = 0;  
      pdf.addImage(contentDataURL, 'PNG', 0, position, imgWidth, imgHeight)  
      pdf.save('DV'+this.idgood); // Generated PDF   

    });  
  }  

}
