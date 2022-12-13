import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListActorRegistryComponent } from './list-actor-registry.component';

describe('ListActorRegistryComponent', () => {
  let component: ListActorRegistryComponent;
  let fixture: ComponentFixture<ListActorRegistryComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListActorRegistryComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListActorRegistryComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
