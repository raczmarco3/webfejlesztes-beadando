import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { GenreService } from '../../service/genre-service';

@Component({
  selector: 'app-new-genre',
  templateUrl: './new-genre.component.html',
  styleUrls: ['./new-genre.component.css']
})
export class NewGenreComponent {

  constructor(private genreService:GenreService) { }

  addGenre = new FormGroup({
    "name": new FormControl("", Validators.required)
  });

  jsonContent: JSON;
  obj: any;
  msg: any;
  processing: boolean;
  submit: boolean = false;

  onSubmit() {
    this.submit = true;
    this.obj = {"name": this.addGenre.controls.name.value};
    this.jsonContent = <JSON>this.obj;

    this.processing = true;
    this.genreService.addGenre(this.jsonContent).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.processing = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false;
        }
      }
    );
  }
}
