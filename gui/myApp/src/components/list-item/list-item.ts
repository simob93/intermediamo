import { 
  Component, 
  Input, 
  Output, 
  EventEmitter } from '@angular/core';

import * as moment from 'moment';
import 'moment/locale/it';

/**
 * Generated class for the ListItemComponent component.
 *
 * See https://angular.io/api/core/Component for more info on Angular
 * Components.
 */
@Component({
  selector: 'list-item',
  templateUrl: 'list-item.html'
})
export class ListItemComponent {

  @Input('data') data: any;
  @Input('icon') icon: any;
  @Input('record') record: any;
  @Input('descrizione') descrizione: String;
  @Output('onClickItem') onClickItem : EventEmitter<any> = new EventEmitter();
  formatattedData: any
  constructor() {
  }
  clickItem() {   
    this.onClickItem.emit(this.record);
  }
   
}
