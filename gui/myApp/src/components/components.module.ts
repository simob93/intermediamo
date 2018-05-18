import { NgModule } from '@angular/core';
import { StdCardComponent } from './std-card/std-card';
import { CardCheckComponent } from './card-check/card-check';
import { ListItemComponent } from './list-item/list-item';
@NgModule({
	declarations: [StdCardComponent,
    CardCheckComponent,
    ListItemComponent],
	imports: [],
	exports: [StdCardComponent,
    CardCheckComponent,
    ListItemComponent]
})
export class ComponentsModule {}
