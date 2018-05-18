import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';

/**
 * Generated class for the VincoliPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-vincoli',
  templateUrl: 'vincoli.html',
})
export class VincoliPage {
  
  tipoMutuo: Array<{descrizione:string, value:number}> = [];
  tipoProvenienza: Array<{descrizione:string, value:number}> = [];

  constructor(public navCtrl: NavController, public navParams: NavParams) {
    this.tipoMutuo = [
      {
        descrizione: 'Provinciale',
        value: 1
      },
      {
        descrizione: 'Bancario',
        value: 2
      },
      {
        descrizione: 'Gilmozzi',
        value: 3
      }
    ];
    this.tipoProvenienza = [
      {
        descrizione: 'Compravendita',
        value: 1
      },
      {
        descrizione: 'Donazione',
        value: 2
      },
      {
        descrizione: 'Successione',
        value: 3
      }
    ];
  }

  ionViewDidLoad() {
  }

}
