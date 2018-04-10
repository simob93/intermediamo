import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { EditContattoPage } from './edit-contatto';

@NgModule({
  declarations: [
    EditContattoPage,
  ],
  imports: [
    IonicPageModule.forChild(EditContattoPage),
  ],
})
export class EditContattoPageModule {}
