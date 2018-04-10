import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';

import { ViewChild } from '@angular/core';
import { Navbar } from 'ionic-angular';

/**
 * Generated class for the DatiCostruzionePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-dati-costruzione',
  templateUrl: 'dati-costruzione.html',
})
export class DatiCostruzionePage {
  immobile: any= {};
  @ViewChild(Navbar) navBar: Navbar;

  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    
    let valoriForm = this.navParams.get('valoriForm'),
        callbackfn = this.navParams.get('callbackfn');

    if (valoriForm) {
        this.immobile = valoriForm;
    }

    this.navBar.backButtonClick = (e:UIEvent)=>{
      if (callbackfn) {
          callbackfn(this.immobile);
      }
      this.navCtrl.pop();
    }
  }

}
