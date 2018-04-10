import { AlertController } from 'ionic-angular';
import { Injectable } from '@angular/core';

@Injectable()
export  class Standard {
    constructor(public alertCtrl: AlertController) {}

    showErrorMessage(message) {
        let text = "";
        message.forEach(element => {
            text += element + '<br>';
        });
        let alert = this.alertCtrl.create({
            title: 'Attenzione',
            subTitle: text,
            buttons: ['OK']
        });
        alert.present();
    }
    
    isEmpty(value) {
        return (value === null || value === undefined || value === ''); 
    }
  }