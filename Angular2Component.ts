import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/router';

import { StaffMember } from './staffMember';
import { StaffService } from '../core/services/staff.service';

@Component({
	moduleId: module.id,
	templateUrl: 'staff-list.component.html',
})
export class StaffListComponent implements OnInit {
	staff: StaffMember[];
	selectedStaffMember: StaffMember;


	constructor(
		private router: Router,
		private staffService: StaffService
	) { }

	ngOnInit(): void {
		this.getStaff();
	}

	getStaff(): void {
		this.staffService.getStaff().then(staff => this.staff = staff);
	}

	onSelect(selected: StaffMember): void {
		this.selectedStaffMember = selected;
		this.gotoDetail();
	}

	gotoDetail(): void {
		this.router.navigate(['/staff', this.selectedStaffMember.id]);
	}
}