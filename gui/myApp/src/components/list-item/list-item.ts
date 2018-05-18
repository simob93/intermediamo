import { Component, Input } from '@angular/core';

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
  @Input('descrizione') descrizione: String;
  formatattedData: any

  constructor() {
    this.formatattedData = moment(this.data).format("HH:mm")
  }

}
