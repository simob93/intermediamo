import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';

import { ViewChild } from '@angular/core';
import { Navbar } from 'ionic-angular';

/**
 * Generated class for the DatiGeneraliPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-dati-generali',
  templateUrl: 'dati-generali.html',
})
export class DatiGeneraliPage {
  immobile: any= {};
  tipologie:Array<{codice: Number, valore: String}>;
  esposizione:Array<{codice: String, valore: String}>;

  @ViewChild(Navbar) navBar: Navbar;

  constructor(public navCtrl: NavController, public navParams: NavParams) {
      this.tipologie = [
          {
            codice: 1,
            valore: 'Monolocale'
          },
          {
            codice: 2,
            valore: 'Bilocale'
          },
          {
            codice: 3,
            valore: 'Trilocale'
          },
          {
            codice: 4,
            valore: 'Quadrilocale'
          },
          {
            codice: 5,
            valore: 'Villetta singola'
          },
          {
            codice: 6,
            valore: 'Villetta a schiera'
          },
          {
            codice: 7,
            valore: 'Rudere'
          },
          {
            codice: 8,
            valore: 'Garage'
          }
      ];
      this.esposizione = [
          {
            codice: 'N',
            valore: 'Nord'
          },
          {
            codice: 'S',
            valore: 'Sud'
          },
          {
            codice: 'E',
            valore: 'Est'
          },
          {
            codice: 'O',
            valore: 'Ovest'
          }
      ]
  }

  ionViewDidLoad() {
    let valoriForm = this.navParams.get('valoriForm'),
    callbackfn = this.navParams.get('callbackfn');

    if (valoriForm) {
        this.immobile = valoriForm;
    }

    this.navBar.backButtonClick = (e:UIEvent)=>{
        if (callbackfn) {
            if (this.immobile.esposizione != null) {
              this.immobile.esposizione = this.immobile.esposizione.toString();
            } 
            callbackfn(this.immobile);
        }
        this.navCtrl.pop();
    }
    console.log('ionViewDidLoad DatiGeneraliPage');
  }

}
